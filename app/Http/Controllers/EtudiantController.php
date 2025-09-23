<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
// storage
use Illuminate\Support\Facades\Storage;
use App\Models\AnneeUniversitaire;
use App\Models\Semestre;
use App\Models\Specialite;
use App\Models\EmploisTempsSpecialite;
// PDF
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\File;
use App\Imports\EtudiantsImport;
use App\Exports\EtudiantsExport;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
class EtudiantController extends Controller
{

    public function importerStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new EtudiantsImport, $request->file('file'));

        // response json
        return response()->json([
            'success' => true,
            'message' => 'Étudiants importés avec succès !'
        ]);
    }

    public function exporter()
    {
        $fileName = 'etudiants_' . now()->format('Y-m-d_H-i') . '.xlsx';

        return Excel::download(
            new EtudiantsExport(),
            $fileName
        );
    }

public function getImage($id)
{
    $dir = "etudiants/temp-$id";

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
            return datatables()->of(Etudiant::query())
                ->addColumn('action', function ($etudiant) {
                    // si etudiant est valider $etudiant->inscription==1 on cache le bouton  'label' => 'Valider L\'inscription'
                    if ($etudiant->inscription == 3 || $etudiant->inscription == 2)
                    {
                            $actions = [
                                [
                                    'label' => 'visualiser Etudiant',
                                    'onclick' => 'openInModal({ link: \'' . route('etudiants.show', $etudiant->id) . '\', size: \'lg\' })',
                                    'permission' => true
                            ],
                            // confirmAction({title,text,confirmButtonText,url,method})
                            [
                                'label' => 'Valider L\'inscription',
                                'onclick' => 'confirmAction({ title: \'Confirmer la validation\', text: \'Voulez-vous vraiment valider l inscription de cet étudiant ?\', confirmButtonText: \'Oui, valider !\', url: \'' . route('etudiants.valider', $etudiant->id) . '\', method: \'GET\' })',
                                'permission' => true
                            ]
                        ];
                    }
                    else
                    {
                        $actions = [
                            [
                                'label' => 'visualiser Etudiant',
                                'onclick' => 'openInModal({ link: \'' . route('etudiants.show', $etudiant->id) . '\', size: \'lg\' })',
                                'permission' => true
                            ],
                            // attestation pdf etudiant
                            //printObject({ link, callback = null, title = 'Print', width = 800, height = 600 })
                            // A4 pour attestation width: 210mm, height: 297mm
                            [
                                'label' => 'Télécharger l\'attestation',
                                'onclick' => 'printObject({ link: \'' . route('etudiants.attestation', $etudiant->id) . '\', title: \'Attestation dinscription - Étudiant\', width: 800, height: 600 })',
                                'permission' => true
                            ]
                        ];
                    }
                    return view('components.buttons.action', compact('actions'));
                })
                // etat inscription
                ->editColumn('etat_inscription', function ($etudiant) {
                    // 3 en attente , 2 donnes emis par etudiant 3 inscription valider
                    return $etudiant->inscription === 3 ? 'En attente' : ($etudiant->inscription === 2 ? 'Données émises par l\'étudiant' : 'Inscription validée');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.etudiants.index', [
            'actions' => [
                [
                    'label' => __('Importer Les Étudiants'),
                    'onclick' => 'openInModal({ link: \'' . route('etudiants.importer') . '\', size: \'sm\' })',
                    'permission' => true,
                ],
                [
                    'label' => __('Exporter Les Étudiants'),
                    'onclick' => 'exportTable(\'' . route('etudiants.exporter') . '\')',
                    'permission' => true,
                ]

            ],
            'title' => "Liste des étudiants",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for creating a new resource.
        return view('pages.etudiants.create', [
            'title' => __('etudiants.create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show($id)
    {

        $etudiant = Etudiant::findOrFail($id);
        return view('pages.etudiants.show', [
            'title' => __('etudiants.show'),
            'actions' => [
                [
                    'label' => __('Valider les informations'),
                    'onclick' => 'confirmDelete(\'' . route('etudiants.valider', $etudiant->id) . '\')',
                    'permission' => true,

                ],
            ],
            'etudiant' => $etudiant
        ]);
    }
    public function store(Request $request)
    {
        // Validate the request data.
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu_naissance' => 'required|string|max:255',
        ]);

        // Create a new Etudiant instance and fill it with the request data.
        $etudiant = new Etudiant();
        $etudiant->nom = $request->input('nom');
        $etudiant->lieu_naissance = $request->input('lieu_naissance');
        $etudiant->save();

        // Redirect or return a response json.
        return response()->json([
            'success' => true,
            'message' => 'Etudiant créé avec succès.'
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('pages.etudiants.edit', [
            'title' => __('etudiants.edit'),
            'etudiant' => $etudiant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data.
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu_naissance' => 'required|string|max:255',
        ]);

        // Find the Etudiant instance and update it with the request data.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->nom = $request->input('nom');
        $etudiant->lieu_naissance = $request->input('lieu_naissance');
        $etudiant->save();

        // Redirect or return a response.
        return response()->json([
            'success' => true,
            'message' => 'Etudiant mis à jour avec succès.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function valider($id)
    {
        // Find the Etudiant instance and validate it.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->inscription = 1;
        $etudiant->save();

        // Redirect or return a response.
         return response()->json([
              'success' => true,
              'message' => 'Etudiant validé avec succès.'
          ]);
    }
    // Importer les étudiants
    public function importer()
    {
        return view('pages.etudiants.importer', [
            'title' => __('etudiants.importer'),
        ]);
    }



    // attestation pdf etudiant
    public function attestation($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $pdf = PDF::loadView('pages.etudiants.export-attestation', [
            'etudiant' => $etudiant
        ]);
        return $pdf->stream('attestation.pdf');
    }

    // emplois etudiant
    public function emploiDuTemps()
    {
        return view('pages.etudiants.emploi_du_temps', [
            'title' => __('etudiants.emploi_du_temps'),
            'specialites' => Specialite::all(),
            'annees' => AnneeUniversitaire::all(),
            'semestres' => Semestre::all()

        ]);
    }
    public function storeEmploiDuTemps(Request $request)
    {
        $validated = $request->validate([
            'specialite_id' => 'required',
            'annee_id' => 'required',
            'semestre_id' => 'required',
            'emplacement' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $emloisTemps = new EmploisTempsSpecialite;
        $emloisTemps->specialite_id = $validated['specialite_id'];
        $emloisTemps->annee_id = $validated['annee_id'];
        $emloisTemps->semestre_id = $validated['semestre_id'];
        // emplacement photo emplois dans public/emplois/
        $emloisTemps->save();
        if ($request->hasFile('emplacement')) {
            $file = $request->file('emplacement');
            // le path de l'emploi du temps doit être stocké dans public/emplois/ et le fichier porte le id EmploisTempsSpecialite
            $emloisTemps->emplacement = 'emplois_specialite/' . $emloisTemps->id . '.' . $file->getClientOriginalExtension();
            File::move($file->getRealPath(), public_path($emloisTemps->emplacement));

        }

        $emloisTemps->save();

        return response()->json(
            [
                'message' => 'Emploi du temps enregistré avec succès',
                'success' => true,
            ]
        );
    }

    public function downloadFolder($etudiantId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);
        $zip = new ZipArchive();
        $zipFileName = 'rescription_' . $etudiant->nodos . '_files.zip';
        // telecharger dans le downloads
        $zipFilePath = storage_path('app/' . $zipFileName);
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $directory = storage_path('app/etudiants/temp-' . $etudiantId);
            if (is_dir($directory)) {
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
                foreach ($files as $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = 'etudiant_' . $etudiantId . '/' . substr($filePath, strlen($directory) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Impossible de créer le fichier ZIP.'], 500);
        }
    }


}
