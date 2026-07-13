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
use App\Models\InscriptionPdg;
use App\Models\InscriptionAdm;
// Hash
use Illuminate\Support\Facades\Hash;
// PDF
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\File;
use App\Imports\EtudiantsImport;
use App\Exports\EtudiantsExport;
use App\Imports\InscriptionAdmImport;
use App\Imports\InscriptionPdgImport;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Mail\BachelierEmail;
use Illuminate\Support\Facades\Mail as Email;
class EtudiantController extends Controller
{

    // updatePhoto
    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // max 2MB
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $dir = "etudiants/temp-$etudiant->id";

        // Créer le dossier s'il n'existe pas
        if (!Storage::disk('local')->exists($dir)) {
            Storage::disk('local')->makeDirectory($dir);
        }

        // Supprimer l'ancienne photo si elle existe
        $files = Storage::disk('local')->files($dir);
        foreach ($files as $file) {
            if (preg_match('/^.*photo\.(jpg|jpeg|png|gif|webp)$/i', basename($file))) {
                Storage::disk('local')->delete($file);
            }
        }

        // Stocker la nouvelle photo
        $photoPath = $request->file('photo')->storeAs($dir, 'photo.' . $request->file('photo')->getClientOriginalExtension(), 'local');

        return redirect()->route('etudiants.profil', $etudiant->id)->with('success', 'Photo mise à jour avec succès.');
    }

    // informations etudiant
    public function profil($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $title = "Profil de l'étudiant";
        return view('pages.etudiants.profil', compact('etudiant', 'title'));
    }

     //updatePassword



    public function updatePassword(Request $request, $id)
    {
        // $request->validate([
        //     'password' => 'required|string|confirmed',
        // ]);

        $etudiant = Etudiant::findOrFail($id);
        $user = \App\Models\Auth\User::findOrFail($etudiant->user_id);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // redirect to home with message success
        return redirect()->route('etudiants.profil', $etudiant->id)->with('success', 'Mot de passe mis à jour avec succès.');
    }


    public function infoEtudiant($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        // view

        return view('pages.etudiants.info', [
            'etudiant' => $etudiant,
            'niveau' => InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()?->specialite?->niveau ?? 'N/A',
            'formation' => InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()?->specialite?->lib_annee_diplome_fr ?? 'N/A'
        ]);
    }

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

public function copier_dossiers_bacheliers()
{
    $dire = "bacheliers/temp";
    $bacheliers = \App\Models\BachelierOrientation::where('inscription', 1)->get();
    foreach($bacheliers as $bachelier){
        //dd($bachelier) ;
        $bachelierDir = $dire . "-" . $bachelier->id;
        $etudiant = Etudiant::where('nni', $bachelier->nni)->first();
        if ($etudiant && Storage::disk('local')->exists($bachelierDir)) {
            $dir = "etudiants/temp-$etudiant->id";
            // Créer le dossier s'il n'existe pas
            if (!Storage::disk('local')->exists($dir)) {
                Storage::disk('local')->makeDirectory($dir);
            }
            // Récupérer tous les fichiers du dossier bachelier
            $files = Storage::disk('local')->files($bachelierDir);
            foreach ($files as $file) {
                // copier chaque fichier vers le dossier de l'étudiant
                Storage::disk('local')->copy($file, $dir . '/' . basename($file));
            }
        }
    }
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

public function downloadBulletin($semestre)
{
    $user = auth()->user();

    if (!$user || !$user->hasRole('Etudiant')) {
        abort(403, 'Accès non autorisé.');
    }

    $etudiant = Etudiant::where('user_id', $user->id)->first();

    if (!$etudiant) {
        abort(404, 'Étudiant introuvable.');
    }

    $semestre = strtoupper((string) $semestre);
    if (!in_array($semestre, ['S1', 'S3', 'S5' , 'S2', 'S4', 'S6'])) {
        abort(404, 'Semestre invalide.');
    }

    $suffix = $etudiant->nodos_suffix;
    if ($suffix === '') {
        abort(404, 'Code dossier introuvable.');
    }
        // mena utiise le dosier la S1S3S5 ou S2S4S6 pour les bulletins
        // donc on doit verifier si le semestre est S1S3S5 ou S2S4S6
    $fileName = $suffix . $semestre . '.png';
    $path = 'S1S3S5/' . $fileName;
    $path2 = 'S2S4S6/' . $fileName;




    if (!Storage::disk('local')->exists($path) && !Storage::disk('local')->exists($path2)) {
        abort(404, 'Bulletin introuvable.');
    } else {
        $path = Storage::disk('local')->exists($path) ? $path : $path2;
    }

    return Storage::disk('local')->download($path, $fileName);
}


    public function index()
    {
        // crrrer des users pour les etudiants
        // $etudiants = Etudiant::where('inscription', 1)
        // ->whereNull("user_id")
        // ->orwhere("user_id", 0)
        // ->whereNotIn("id" , [382,436])
        // ->get();
        // foreach ($etudiants as $etudiant) {
        //     if (!$etudiant->user_id && $etudiant->email ) {
        //         $user = new \App\Models\Auth\User();
        //         $user->name = $etudiant->nom_fr ;
        //         $user->email = $etudiant->email;
        //         $user->password = Hash::make($etudiant->nni); // Mot de passe par défaut, à changer
        //         $user->save();

        //         $etudiant->user_id = $user->id;
        //         $etudiant->save();

        //         $user->assignRole('Etudiant');
        //     }
        // }


        if (request()->ajax()) {
            return datatables()->of(Etudiant::query())
                ->addColumn('action', function ($etudiant) {
                    $user = auth()->user();
                    // si etudiant est valider $etudiant->inscription==1 on cache le bouton  'label' => 'Valider L\'inscription'
                    if ($etudiant->inscription == 3 || $etudiant->inscription == 2)
                    {

                            $actions = [
                                [
                                    'label' => 'Visualiser Etudiant',
                                    'onclick' => 'openInModal({ link: \'' . route('etudiants.show', $etudiant->id) . '\', size: \'lg\' })',
                                    'permission' => true
                            ],
                            // confirmAction({title,text,confirmButtonText,url,method})
                            [
                                'label' => 'Valider L\'inscription',
                                'onclick' => 'confirmAction({ title: \'Confirmer la validation\', text: \'Voulez-vous vraiment valider l inscription de cet étudiant ?\', confirmButtonText: \'Oui, valider !\', url: \'' . route('etudiants.valider', $etudiant->id) . '\', method: \'GET\' })',
                                'permission' => $user->id == 9 ? false : true
                            ]
                            ,
                            [
                                'label' => 'Rejeter L\'inscription',
                                'onclick' => 'confirmAction({ title: \'Confirmer le rejet\', text: \'Voulez-vous vraiment rejeter l inscription de cet étudiant ?\', confirmButtonText: \'Oui, rejeter !\', url: \'' . route('etudiants.rejeter', $etudiant->id) . '\', method: \'GET\' })',
                                'permission' => $user->id == 9 ? false : true
                            ]
                        ];
                    }
                    else
                    {
                        $actions = [
                            [
                                'label' => 'Visualiser Etudiant',
                                'onclick' => 'openInModal({ link: \'' . route('etudiants.show', $etudiant->id) . '\', size: \'lg\' })',
                                'permission' => true
                            ],
                            // attestation pdf etudiant
                            //printObject({ link, callback = null, title = 'Print', width = 800, height = 600 })
                            // A4 pour attestation width: 210mm, height: 297mm
                            // motif de rejet
                            [
                                'label' => 'Motif de rejet',
                                'onclick' => 'openInModal({ link: \'' . route('etudiants.edit', $etudiant->id) . '\', size: \'md\' })',
                                'permission' => $user->id == 9 ? false : true
                            ]
                        ];
                    }
                    return view('components.buttons.action', compact('actions'));
                })
                // etat inscription
                ->editColumn('inscription', function ($etudiant) {
                    // 3 en attente , 2 donnes emis par etudiant 1 inscriptioion valider 4 rejeter

                    if ($etudiant->inscription == "3") {
                        return '<span class="badge bg-warning">En attente</span>';
                    } elseif ($etudiant->inscription == '2') {
                        return '<span class="badge bg-info text-dark">Dossier reçu</span>';
                    } elseif ($etudiant->inscription == '1') {
                        return '<span class="badge bg-success">Validé</span>';
                    } elseif ($etudiant->inscription == '4') {
                        return '<span class="badge bg-danger">Rejeté</span>';
                    } else {
                        return '<span class="badge bg-secondary">Non soumis</span>';
                    }
                })
                ->rawColumns(['action' , 'inscription'])
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
                // ,adm inscription
                ,[
                    'label' => __('Importer Inscription Adm'),
                    'onclick' => 'openInModal({ link: \'' . route('etudiants.importer.inscriptions_adm') . '\', size: \'sm\' })',
                    'permission' => true,
                ],
                [
                    'label' => __('Importer Inscription Pdg'),
                    'onclick' => 'openInModal({ link: \'' . route('etudiants.importer.inscriptions_pdg') . '\', size: \'sm\' })',
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
            'motif_rejet' => 'required',
        ]);

        // Find the Etudiant instance and update it with the request data.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->motif_rejet = $request->input('motif_rejet');
        $etudiant->save();
        $this->sendEmailForm($id);

        // Redirect or return a response.
        return response()->json([
            'success' => true,
            'message' => 'Motif de rejet est envoyé avec succès.'
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

        $etudiant_ob = Etudiant::findOrFail($id);

       $institution = [
            'nom' => 'Institut Supérieur XYZ',
            'adresse' => 'Avenue de l’Excellence, Nouakchott',
            'telephone' => '+222 44 44 44 44',
            'email' => 'contact@xyz.edu.mr',
            'logo_base64' => null,
        ];
        $inscription_adm = InscriptionAdm::where('etudiant_id', $id);
        $etudiant = [
            'id' => $etudiant_ob->id,
            'matricule' => $etudiant_ob->nodos,
            'nom' => $etudiant_ob->nom_fr,
            'nni' => $etudiant_ob->nni,
            'date_naissance' => $etudiant_ob->date_naissance,
            'lieu_naissance' => $etudiant_ob->lieu_naissance_fr,
            'filiere' => $etudiant_ob->filiere,
            'niveau' => InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()->specialite->niveau ?? 'N/A',
            'formation' => InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()->specialite->lib_annee_diplome_fr ?? 'N/A',
        ];
        $annee = '2025/2026';
        $inscriptions_pdg = InscriptionPdg::where('etudiant_id', $id)
            ->with(['semestre', 'matiere', 'module'])
            ->get();


        // Transformer les inscriptions PDG en programme d'enseignement
        // recuperer les  deux semestres
        $semestres = Semestre::whereIn('id', $inscriptions_pdg->pluck('semestre_id')->unique())->get();
        $volumeHoraireNumeric = InscriptionPdg::where('etudiant_id', $id)->sum('nb_heure');
        $creditsNumeric = InscriptionPdg::where('etudiant_id', $id)->sum('credit');
        $programme =
            $semestres->map(function ($semestre) use ($id) {
                return [
                    'semestre' => $semestre->lib_semestre_fr,
                    "elements" => InscriptionPdg::where('semestre_id', $semestre->id)
                   ->where('etudiant_id', $id)->get()->map(function ($inscription) {
                        //dd();
                        return [
                            'module' => \App\Models\Module::find($inscription->module_id)?->lib_module_fr,
                            'element' => $inscription->element_id ?? 'N/A',
                            'volume_horaire' => $inscription->nb_heure . 'h',
                            'credits' => $inscription->credit ?? 'N/A',
                            'volume_horaire_numeric' => $inscription->nb_heure ,
                            'credits_numeric' => $inscription->credit ?? 0,
                            'matiere' => $inscription->matiere->lib_element_fr ?? 'N/A',
                        ];
                    })->toArray(),
                ];
            })->toArray();
        return view('pages.etudiants.export-attestation', compact('institution', 'etudiant', 'annee', 'programme'
        , 'volumeHoraireNumeric', 'creditsNumeric'));
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
        $folderPath = storage_path("app/etudiants/temp-$etudiantId");
        if (!file_exists($folderPath)) {
            return response()->json(['error' => 'Dossier introuvable.'], 404);
        }
        $zipFileName = "etudiant_{$etudiant->matricule}_files.zip";
        $zipFilePath = storage_path("app/etudiants/$zipFileName");
        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Impossible de créer le fichier ZIP.'], 500);
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    // rejeter etudiant
    public function rejeter($id)
    {
        // Find the Etudiant instance and validate it.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->inscription = 4;
        $etudiant->save();
        // Redirect or return a response.
         return response()->json([
              'success' => true,
              'message' => 'Etudiant rejeté avec succès.'
          ]);
      }

       // send email to bachelier GET
    public function sendEmailForm($id)
    {

        $etudiant = Etudiant::findOrFail($id);
        try {
            $data['name'] = $etudiant->nom_fr;
            $data['email'] = $etudiant->email;
            $data['content'] = $etudiant->motif_rejet;
            Email::to($etudiant->email)->send(new BachelierEmail($data));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage()], 500);
        }
        return response()->json(['success' => true]);
    }

    // InscriptionAdmImport
    public function importerInscriptionAdmStore(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new InscriptionAdmImport, $request->file('document'));

        // response json
        return response()->json([
            'success' => true,
            'message' => 'Inscriptions administratives importées avec succès !'
        ]);
    }

    // InscriptionPdgImport
    public function importerInscriptionPdgStore(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new InscriptionPdgImport, $request->file('document'));

        // response json
        return response()->json([
            'success' => true,
            'message' => 'Inscriptions PDG importées avec succès !'
        ]);
    }

    // vue importer inscription adm
    public function importerInscriptionAdm()
    {
        return view('pages.etudiants.importer-adm');
    }
    // vue importer inscription pdg
    public function importerInscriptionPdg()
    {
        return view('pages.etudiants.importer-pdg');
    }

    // absences etudiant
    public function absences($id){
        $etudiant = Etudiant::findOrFail($id);
        $absences = \App\Models\Absence::where('matrucle', $etudiant->nodos)->get();
        return view('pages.etudiants.absences', [
            'title' => __('etudiants.absences'),
            'etudiant' => $etudiant,
            'absences' => $absences
        ]);
    }

    // Affiche la convocation de l'étudiant
    public function convocation($id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        // recuperer la model convocation
        $convecations = \App\Models\Convocation::where('matrucle', $etudiant->nodos)->get();
        // annese universitaire en cours
        $annee_en_cours = AnneeUniversitaire::where('etat', 1)->first();
         $niveau = InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()?->specialite?->niveau ?? 'N/A';
        $formation = InscriptionAdm::where('etudiant_id', $id)->with('specialite')->first()?->specialite?->lib_annee_diplome_fr ?? 'N/A';
        return view('pages.etudiants.convocation', compact('etudiant', 'convecations', 'annee_en_cours', 'niveau', 'formation'));
    }
}
