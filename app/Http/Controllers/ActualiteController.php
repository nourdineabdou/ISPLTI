<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
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
                                'onclick' => 'openInModal({ link: \'' . route('actualites.edit', $actualite->id) . '\', size: \'lg\' })',
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
                        'onclick' => 'openInModal({ link: \'' . route('actualites.create') . '\', size: \'lg\' })',
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
        return response()->json([ 'success' => true, 'message' => 'Actualité créée avec succès.'], 200);
    }

    public function edit($id)
    {
        $actualite = Actualite::findOrFail($id);
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
        return response()->json([ 'success' => true, 'message' => 'Actualité mise à jour avec succès.'], 200);
    }
    public function statut($id)
    {
        $actualite = Actualite::findOrFail($id);
        $actualite->statut = $actualite->statut === 'publie' ? 'brouillon' : 'publie';
        $actualite->save();
        return response()->json([ 'success' => true, 'message' => 'Statut de l\'actualité changé avec succès.'], 200);
    }


}
