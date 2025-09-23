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
                                'permission' => true
                            ]
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
                ->editColumn('etat_inscription', function ($bachelier) {
                    // 3 en attente , 2 donnes emis par etudiant 3 inscription valider

                    return $bachelier->inscription === '3' ? 'En attente' : ($bachelier->inscription === '2' ? 'Données émises par le bachelier' : 'Inscription validée');
                })
                ->rawColumns(['action'])
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
}
