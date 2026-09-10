<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use App\Models\ActualiteFichier;
use App\Models\ActualiteImage;
use App\Models\ActualiteVideo;
use Illuminate\Support\Facades\File;
class ActualiteController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
                return datatables()->of(Actualite::query())
                    ->addColumn('action', function ($actualite) {
                        $actions = [
                            [
                                'label' => 'Modifier actualité',
                                'onclick' => 'openInModal({ link: \'' . route('actualites.edit', $actualite->id) . '\', size: \'xl\' })',
                                'permission' => true
                            ],
                            // statut publie ou brouillon
                            [
                                'label' => $actualite->statut === 'publie' ? 'brouillon' : 'publie',
                                'onclick' => 'confirmAction({ title: \'Confirmer le changement de statut\', text: \'Voulez-vous vraiment changer le statut de cette actualité ?\', confirmButtonText: \'Oui, changer !\', url: \'' . route('actualites.statut', $actualite->id) . '\', method: \'GET\' })',
                                'permission' => true
                            ],
                        ];
                        return view('components.buttons.action', compact('actions'));
                    })
                    ->editColumn('statut', function ($actualite) {
                        return $actualite->statut === 'publie' ? '<span class="badge badge-success">Publié</span>' : '<span class="badge badge-warning">Brouillon</span>';
                    })
                    ->rawColumns(['action','statut'])
                    ->make(true);
        }

        return view('pages.actualites.index', [
                'actions' => [
                    [
                        'label' => __('actualites.create'),
                        'onclick' => 'openInModal({ link: \'' . route('actualites.create') . '\', size: \'xl\' })',
                        'permission' => true
                    ]
                ],
                'title' => __('actualites.list'),
        ]);
    }

    public function create()
    {
        return view('pages.actualites.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre_fr' => 'required|string|max:255',
            'titre_en' => 'required|string|max:255',
            'titre_ar' => 'required|string|max:255',
            'contenu_fr' => 'required|string',
            'contenu_en' => 'required|string',
            'contenu_ar' => 'required|string',
            'statut' => 'required|in:publie,brouillon',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'auteur' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,webm|max:51200',
            'fichiers.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'fichiers_nom_fr.*' => 'nullable|string|max:255',
            'fichiers_nom_ar.*' => 'nullable|string|max:255',
            'fichiers_description_fr.*' => 'nullable|string|max:1000',
            'fichiers_description_ar.*' => 'nullable|string|max:1000',
        ]);

        $actualite = new Actualite();
        $actualite->titre_fr = $validated['titre_fr'];
        $actualite->titre_en = $validated['titre_en'];
        $actualite->titre_ar = $validated['titre_ar'];
        $actualite->contenu_fr = $validated['contenu_fr'];
        $actualite->contenu_en = $validated['contenu_en'];
        $actualite->contenu_ar = $validated['contenu_ar'];
        $actualite->statut = $validated['statut'];
        $actualite->auteur = $validated['auteur'];
        $actualite->date_publication = now();
        $actualite->save();
        if ($request->hasFile('image')) {
            //faire le mouvement de fichier dans public/actualites/
            File::move($request->file('image')->getRealPath(), public_path('actualites/' . $actualite->id . '.' . $request->file('image')->getClientOriginalExtension()));
            $actualite->image = 'actualites/' . $actualite->id . '.' . $request->file('image')->getClientOriginalExtension();
            $actualite->save();
        }
        else {
            // si pas d'image mettre une image par defaut
            $actualite->image = 'actualites/default.png';
            $actualite->save();
        }

        $this->storeImages($actualite, $request);
        $this->storeVideos($actualite, $request);
        $this->storeFichiers($actualite, $request);

        return response()->json([ 'success' => true, 'message' => 'Actualité créée avec succès.'], 200);
    }

    public function edit($id)
    {
        $actualite = Actualite::with(['images', 'videos', 'fichiers'])->findOrFail($id);
        return view('pages.actualites.edit', compact('actualite'));
    }
    public function update(Request $request, $id)
    {
        $actualite = Actualite::findOrFail($id);
        $validated = $request->validate([
            'titre_fr' => 'required|string|max:255',
            'titre_en' => 'required|string|max:255',
            'titre_ar' => 'required|string|max:255',
            'contenu_fr' => 'required|string',
            'contenu_en' => 'required|string',
            'contenu_ar' => 'required|string',
            'statut' => 'required|in:publie,brouillon',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'auteur' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,webm|max:51200',
            'fichiers.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
            'fichiers_nom_fr.*' => 'nullable|string|max:255',
            'fichiers_nom_ar.*' => 'nullable|string|max:255',
            'fichiers_description_fr.*' => 'nullable|string|max:1000',
            'fichiers_description_ar.*' => 'nullable|string|max:1000',
        ]);

        $actualite->titre_fr = $validated['titre_fr'];
        $actualite->titre_en = $validated['titre_en'];
        $actualite->titre_ar = $validated['titre_ar'];
        $actualite->contenu_fr = $validated['contenu_fr'];
        $actualite->contenu_en = $validated['contenu_en'];
        $actualite->contenu_ar = $validated['contenu_ar'];
        $actualite->statut = $validated['statut'];
        $actualite->auteur = $validated['auteur'];
        $actualite->date_publication = now();
        if ($request->hasFile('image')) {
            //faire le mouvement de fichier dans public/images/actualites/
            File::move($request->file('image')->getRealPath(), public_path('actualites/' . $actualite->id . '.' . $request->file('image')->getClientOriginalExtension()));
            $actualite->image = 'actualites/' . $actualite->id . '.' . $request->file('image')->getClientOriginalExtension();
        }
        $actualite->save();

        $this->deleteMarked($request, $actualite, ActualiteImage::class, 'delete_images');
        $this->deleteMarked($request, $actualite, ActualiteVideo::class, 'delete_videos');
        $this->deleteMarked($request, $actualite, ActualiteFichier::class, 'delete_fichiers');

        $this->storeImages($actualite, $request);
        $this->storeVideos($actualite, $request);
        $this->storeFichiers($actualite, $request);

        return response()->json([ 'success' => true, 'message' => 'Actualité mise à jour avec succès.'], 200);
    }

    private function storeImages(Actualite $actualite, Request $request): void
    {
        foreach ($request->file('images', []) as $index => $file) {
            if (!$file) {
                continue;
            }
            $image = ActualiteImage::create([
                'actualite_id' => $actualite->id,
                'chemin' => '',
                'ordre' => $index,
            ]);
            $chemin = 'actualites/' . $actualite->id . '/images/' . $image->id . '.' . $file->getClientOriginalExtension();
            File::ensureDirectoryExists(public_path('actualites/' . $actualite->id . '/images'));
            File::move($file->getRealPath(), public_path($chemin));
            $image->update(['chemin' => $chemin]);
        }
    }

    private function storeVideos(Actualite $actualite, Request $request): void
    {
        foreach ($request->file('videos', []) as $index => $file) {
            if (!$file) {
                continue;
            }
            $video = ActualiteVideo::create([
                'actualite_id' => $actualite->id,
                'chemin' => '',
                'ordre' => $index,
            ]);
            $chemin = 'actualites/' . $actualite->id . '/videos/' . $video->id . '.' . $file->getClientOriginalExtension();
            File::ensureDirectoryExists(public_path('actualites/' . $actualite->id . '/videos'));
            File::move($file->getRealPath(), public_path($chemin));
            $video->update(['chemin' => $chemin]);
        }
    }

    private function storeFichiers(Actualite $actualite, Request $request): void
    {
        $nomsFr = $request->input('fichiers_nom_fr', []);
        $nomsAr = $request->input('fichiers_nom_ar', []);
        $descriptionsFr = $request->input('fichiers_description_fr', []);
        $descriptionsAr = $request->input('fichiers_description_ar', []);
        foreach ($request->file('fichiers', []) as $index => $file) {
            if (!$file) {
                continue;
            }
            $fichier = ActualiteFichier::create([
                'actualite_id' => $actualite->id,
                'chemin' => '',
                'nom_fr' => $nomsFr[$index] ?? $file->getClientOriginalName(),
                'nom_ar' => $nomsAr[$index] ?? null,
                'description_fr' => $descriptionsFr[$index] ?? null,
                'description_ar' => $descriptionsAr[$index] ?? null,
                'taille' => $file->getSize(),
                'ordre' => $index,
            ]);
            $chemin = 'actualites/' . $actualite->id . '/fichiers/' . $fichier->id . '.' . $file->getClientOriginalExtension();
            File::ensureDirectoryExists(public_path('actualites/' . $actualite->id . '/fichiers'));
            File::move($file->getRealPath(), public_path($chemin));
            $fichier->update(['chemin' => $chemin]);
        }
    }

    private function deleteMarked(Request $request, Actualite $actualite, string $modelClass, string $inputName): void
    {
        $ids = $request->input($inputName, []);
        if (empty($ids)) {
            return;
        }
        $items = $modelClass::whereIn('id', $ids)->where('actualite_id', $actualite->id)->get();
        foreach ($items as $item) {
            if ($item->chemin && File::exists(public_path($item->chemin))) {
                File::delete(public_path($item->chemin));
            }
            $item->delete();
        }
    }
    public function statut($id)
    {
        $actualite = Actualite::findOrFail($id);
        $actualite->statut = $actualite->statut === 'publie' ? 'brouillon' : 'publie';
        $actualite->save();
        return response()->json([ 'success' => true, 'message' => 'Statut de l\'actualité changé avec succès.'], 200);
    }


}
