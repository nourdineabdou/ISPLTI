<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BachelierOrientation;
// storage
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BacheliersImport;
use App\Exports\BacheliersExport;
use ZipArchive;
// Email
use Illuminate\Support\Facades\Mail as Email;
use App\Mail\BachelierEmail;

class BachelierController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new BacheliersImport, $request->file('file'));

        return back()->with('success', 'Bacheliers importés avec succès !');
    }

    public function exporter()
    {
        $fileName = 'bacheliers_' . now()->format('Y-m-d_H-i') . '.xlsx';

        return Excel::download(
            new BacheliersExport(),
            $fileName
        );
    }
    // edit bachelier
    public function edit($id)
    {
        $bachelier = BachelierOrientation::findOrFail($id);
        return view('pages.bacheliers.edit', compact('bachelier'));
    }
    // update bachelier
    public function update(Request $request, $id)
    {
        $bachelier = BachelierOrientation::findOrFail($id);
        $request->validate([
            'motif_rejet' => 'nullable|string|max:255',
        ]);
        $bachelier->motif_rejet = $request->motif_rejet;
        $bachelier->save();
        $this->sendEmailForm($id);
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Bachelier mis à jour avec succès !',
            'data' => $bachelier
        ]);
        //return redirect()->route('bacheliers.index')->with('success', 'Bachelier mis à jour avec succès !');
    }

public function getImage($id)
{
    $dir = "bacheliers/temp-$id";

    // Vérifier si le dossier existe
    if (!Storage::disk('local')->exists($dir)) {
        abort(404, "Dossier introuvable");
    }

    // Récupérer tous les fichiers
    $files = Storage::disk('local')->files($dir);

    // Chercher un fichier qui commence par "photo."
    $photoFile = collect($files)->first(function ($file) {
        return preg_match('/^.*photo\.(jpg|jpeg|png|gif|webp)$/i', basename($file));
    });

    if (!$photoFile) {
        abort(404, "Fichier photo introuvable");
    }

    // Récupérer et retourner l’image
    $file = Storage::disk('local')->get($photoFile);
    $type = Storage::disk('local')->mimeType($photoFile);

    return response($file, 200)->header('Content-Type', $type);
}


    public function index()
    {
        //index
        if (request()->ajax()) {
            return datatables()->of(BachelierOrientation::query())
                ->addColumn('action', function ($bachelier) {
                    // si bachelier est valider $bachelier->inscription==1 on cache le bouton  'label' => 'Valider L\'inscription'
                    $user = auth()->user();
                    if ($bachelier->inscription == 3 || $bachelier->inscription == 2)
                    {
                            $actions = [
                                [
                                    'label' => 'visualiser Bachelier',
                                    'onclick' => 'openInModal({ link: \'' . route('bacheliers.show', $bachelier->id) . '\', size: \'lg\' })',
                                    'permission' => true
                            ],
                            // confirmAction({title,text,confirmButtonText,url,method})
                            [
                                'label' => 'Valider L\'inscription',
                                'onclick' => 'confirmAction({ title: \'Confirmer la validation\', text: \'Voulez-vous vraiment valider l inscription de cet étudiant ?\', confirmButtonText: \'Oui, valider !\', url: \'' . route('bacheliers.valider', $bachelier->id) . '\', method: \'GET\' })',
                                'permission' => $user->id == 9 ? false : true
                            ],
                            // deque je rejeter le bachelier je veux qui mafiche visulier etudiant rejeter
                            [
                                'label' => 'Rejeter L\'inscription',
                                'onclick' => 'confirmAction({ title: \'Confirmer le rejet\', text: \'Voulez-vous vraiment rejeter l inscription de cet étudiant ?\', confirmButtonText: \'Oui, rejeter !\', url: \'' . route('bacheliers.rejeter', $bachelier->id) . '\', method: \'GET\' })',
                                'permission' => $user->id == 9 ? false : true
                            ]
                        ];
                    }
                    elseif($bachelier->inscription == 4)
                    {
                        $actions = [
                            [
                                'label' => 'visualiser Bachelier',
                                'onclick' => 'openInModal({ link: \'' . route('bacheliers.show', $bachelier->id) . '\', size: \'lg\' })',
                                'permission' => true
                            ],
                            [
                                'label' => 'Modifier le motif de rejet',
                                'onclick' => 'openInModal({ link: \'' . route('bacheliers.edit', $bachelier->id) . '\', size: \'lg\' })',
                                'permission' => $user->id == 9   ? false : true
                            ] ,
                        ];
                    }
                    else
                    {
                        $actions = [
                            [
                                'label' => 'visualiser Bachelier',
                                'onclick' => 'openInModal({ link: \'' . route('bacheliers.show', $bachelier->id) . '\', size: \'lg\' })',
                                'permission' => true
                            ],
                        ];
                    }

                    return view('components.buttons.action', compact('actions'));

                })
                // etat inscription
                ->editColumn('inscription', function ($bachelier) {
                    // 3 en attente , 2 donnes emis par etudiant 3 inscription valider
                    // 4 rejeté
                    if ($bachelier->inscription == '1') {
                        return '<span class="badge bg-success">Inscription Validée</span>';
                    } elseif ($bachelier->inscription == '2') {
                        return '<span class="badge bg-info text-dark">Données émises</span>';
                    } elseif ($bachelier->inscription == '3') {
                        return '<span class="badge bg-warning text-dark">En attente de validation</span>';
                    } elseif ($bachelier->inscription == '4') {
                        return '<span class="badge bg-danger">Inscription Rejetée</span>';
                    } else {
                        return '<span class="badge bg-secondary">Non Inscrit</span>';
                    }
                })
                ->rawColumns(['action' , 'inscription'])
                ->make(true);
        }
        return view('pages.bacheliers.index', [
            'actions' => [
                [
                    'label' => __('Importer Les Bacheliers'),
                    'onclick' => 'openInModal({ link: \'' . route('bacheliers.importer') . '\', size: \'sm\' })',
                    'permission' => true,
                ],
                [
                    'label' => __('Exporter Les Bacheliers'),
                    'onclick' => 'exportTable(\'' . route('bacheliers.exporter') . '\')',
                    'permission' => true,
                ]

            ],
            'title' => "Liste des bacheliers",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for creating a new resource.
        return view('pages.bacheliers.create', [
            'title' => __('bacheliers.create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show($id)
    {

        $bachelier = BachelierOrientation::findOrFail($id);
        return view('pages.bacheliers.show', [
            'title' => __('bacheliers.show'),
            'actions' => [
                [
                    'label' => __('Valider les informations'),
                    'onclick' => 'confirmDelete(\'' . route('bacheliers.valider', $bachelier->id) . '\')',
                    'permission' => true,

                ],
            ],
            'bachelier' => $bachelier
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function valider($id)
    {
        // Find the Bachelier instance and validate it.
        $bachelier = BachelierOrientation::findOrFail($id);
        $bachelier->inscription = 1;
        $bachelier->save();

        // Redirect or return a response.
         return response()->json([
              'success' => true,
              'message' => 'Bachelier validé avec succès.'
          ]);
    }

    // rejeter le bachelier
    public function rejeter($id)
    {
        // Find the Bachelier instance and reject it.
        $bachelier = BachelierOrientation::findOrFail($id);
        $bachelier->inscription = 4;
        $bachelier->save();

        // Redirect or return a response.
         return response()->json([
              'success' => true,
              'message' => 'Bachelier rejeté avec succès.'
          ]);
    }
    // Importer les bacheliers
    public function importer()
    {
        return view('pages.bacheliers.importer', [
            'title' => __('bacheliers.importer'),
        ]);
    }



    // attestation pdf bachelier
    public function attestation($id)
    {
        // Exemple de données. Remplacez par vos modèles/db.
        $institution = [
            'nom' => 'Institut Supérieur XYZ',
            'adresse' => 'Avenue de l’Excellence, Nouakchott',
            'telephone' => '+222 44 44 44 44',
            'email' => 'contact@xyz.edu.mr',
            'logo_base64' => null,
        ];
        $etudiant = [
            'matricule' => '2025-00123',
            'nom' => 'Nourdine Med Souleymane',
            'date_naissance' => '1999-08-15',
            'lieu_naissance' => 'Nouakchott',
            'filiere' => 'Informatique',
            'niveau' => 'Licence 2',
        ];
        $annee = '2025/2026';
        $stats = [
            'ects_acquis' => 48,
            'moyenne_generale' => 13.75,
            'rang' => '15 / 220',
            'taux_presence' => '92%',
            'ue_validees' => 10,
        ];
        return view('pages.bacheliers.export-attestation', compact('institution', 'etudiant', 'annee', 'stats'));
    }
    public function downloadFolder($bachelierId)
    {
        $bachelier = BachelierOrientation::findOrFail($bachelierId);
        $folderPath = storage_path("app/bacheliers/temp-$bachelierId");

        if (!file_exists($folderPath)) {
            return response()->json(['error' => 'Dossier introuvable.'], 404);
        }

        $zipFileName = "bachelier_{$bachelier->num_bac}_".'.zip';
        $zipFilePath = storage_path("app/bacheliers/$zipFileName");

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $files = scandir($folderPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $folderPath . '/' . $file;
                    if (is_file($filePath)) {
                        $zip->addFile($filePath, $file);
                    }
                }
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Impossible de créer le fichier ZIP.'], 500);
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    // send email to bachelier GET
    public function sendEmailForm($id)
    {

        $bachelier = BachelierOrientation::findOrFail($id);
        try {
            $data['name'] = $bachelier->nom_fr;
            $data['email'] = $bachelier->email;
            $data['content'] = $bachelier ->motif_rejet ;
            Email::to($bachelier->email)->send(new BachelierEmail($data));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage()], 500);
        }
        return response()->json(['success' => true]);
    }

}
