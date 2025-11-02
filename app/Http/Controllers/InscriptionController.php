<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\BachelierOrientation;
use App\Models\Etudiant;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
// session
use Illuminate\Support\Facades\Session;

// file
use Illuminate\Support\Facades\File;

// storage
use Illuminate\Support\Facades\Storage;
class InscriptionController extends Controller
{
    // créer moi une methode qui permet de predre en paremètre un tableau et afficher le nombre premiere
    public function afficherNombrePremiere(array $nombres)
    {
        $nombresPremiers = array_filter($nombres, function ($nombre) {
            return $this->estPremier($nombre);
        });

        return response()->json($nombresPremiers);
    }

    public function inscriptions()
    {
        $bachelierId = Session::get('bachelier_id');
        if($bachelierId) {
            $bachelier = BachelierOrientation::find($bachelierId);
            // retourner la vue d'inscription avec les données du bachelier
            $etudiant = Etudiant::where('nni', $bachelier->nni)->first();
            dd($etudiant);
            return view('inscriptions.reponse_etudiant', compact('etudiant'));
        }
        return view('inscriptions.inscriptions');
    }

    public function rescription()
    {
        // récupérer l'étudiant de la session
        $etudiantId = Session::get('etudiant_id');
        if($etudiantId) {
            $etudiant = Etudiant::find($etudiantId);
            // retourner la vue de réinscription avec les données de l'étudiant
            return view('inscriptions.rescription', compact('etudiant'));
        }
        return redirect()->route('auth.login_etudiant');
    }

    public function login1()
    {
        // $user = User::firstOrCreate(['email' => 'visualiser@gmail.com'], [
        //     'name'=>'visualiser',
        //     'email'=>'visualiser@gmail.com',
        //     'password'=>bcrypt('2025')
        // ]);
        // $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        // $user->assignRole([$role->id]);
        // $permissions = ['bachelier-create', 'bachelier-edit', 'bachelier-export_attestation'];
        // // créer les permissions
        // foreach ($permissions as $permission) {
        //     \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        // }
        // $user = User::firstOrCreate(['email' => 'bachelier@isptl.com'], [
        //     'name' => 'bachelier',
        //     'email' => 'bachelier@isptl.com',
        //     'password' => bcrypt('bachelier2025')
        // ]);
        // $roleBachelier = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Bachelier']);
        // $roleBachelier->syncPermissions($permissions);
        // $user->assignRole([$roleBachelier->id]);
        // get session bachelier
         $bachelierId = Session::get('bachelier_id');

         if($bachelierId) {
             $bachelier = BachelierOrientation::find($bachelierId);
             // $etudiant = Etudiant::where('nni', $bachelier->nni)->first();
             $etudiant = Etudiant::where('nni', $bachelier->nni)->first();
             // retourner la vue d'inscription avec les données du bachelier
             if($etudiant->inscription == 2 || $etudiant->inscription == 1){
                return view('inscriptions.reponse_etudiant', compact('etudiant'));
             }
             return view('inscriptions.inscriptions', compact('bachelier'));
         }

        return view('auth.Login_bachelier');
    }

    public function login2()
    {
        $etudiantId = Session::get('etudiant_id');
        //dd($etudiantId);
        if($etudiantId) {
            $etudiant = Etudiant::find($etudiantId);
            if($etudiant->inscription == 2 || $etudiant->inscription == 1){
                return view('inscriptions.reponse_etudiant', compact('etudiant'));
            }
            else
                return view('inscriptions.rescription', compact('etudiant'));
        }
        return view('auth.login_etudiant');
    }

    //login_etudiant
    public function login_etudiant(Request $request)
    {
        // Valider les informations d'identification
        $request->validate([
            'matricule' => 'required',
            'nni' => 'required',
        ]);
        $credentials = $request->only('matricule', 'nni');
        $etudiant = Etudiant::where("nodos", $credentials['matricule'])->where("nni", $credentials['nni'])->first();
        if (!$etudiant)
            return back()->withErrors([
                'matricule' => 'Donnees invalides veuillez reessayer.',
            ]);
        Session::forget('bachelier_id');
        Session(['etudiant_id' => $etudiant->id]);
        // créer une session pour l'étudiant
         if($etudiant && ($etudiant->inscription == 2 || $etudiant->inscription == 1)){

             return view('inscriptions.reponse_etudiant', compact('etudiant'));
         }

        // supprimer la session de bachelier

        // créer le session etudiant_id
        //Session(['etudiant_id' => $etudiant->id]);
        return view('inscriptions.rescription', compact('etudiant'));
    }

    // login_bachelier
    public function login_bachelier(Request $request)
    {
        // Valider les informations d'identification
        $request->validate([
            'nii' => 'required',
            'bac' => 'required',
        ]);
        $credentials = $request->only('nii', 'bac');
        $bachelier = BachelierOrientation::where("nni", $credentials['nii'])->where("num_bac", $credentials['bac'])->first();
        if (!$bachelier)
            return back()->withErrors([
                'nii' => 'Donnees invalides veuillez reessayer.',
            ]);
        else{
            // créer un Auth d'inscription login: bachelier@isptl.com : mots de passe:bachelier2025
             //if(Auth::attempt(['email' => 'bachelier@isptl.com', 'password' => 'bachelier2025']))
             // créer une session pour le bachelier
                Session(['bachelier_id' => $bachelier->id]);
                //supprimer la session de l'étudiant
                Session::forget('etudiant_id');
                if($bachelier && ($bachelier->inscription == 2 || $bachelier->inscription == 1)){
                    return view('inscriptions.reponse_bachelier', compact('bachelier'));
                }
                return view('inscriptions.inscriptions', compact('bachelier'));

        }

    }

    // store inscriptions d'un bachelier
    public function store(Request $request, $bachelierID)
    {
            // valider les données
            $request->validate([
                'tel' => 'required|string|max:15',
                'num_correspondant' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'doc_bac' => 'required|file|max:2048', // max 2MB
                'nni' => 'required|file|max:2048', // max 2MB
                'cert_medical' => 'required|file|max:2048', // max 2MB
                'photo' => 'required|image|max:2048', // max 2MB
                'capture_paiement' => 'required|file|max:2048', // max 2MB
            ] ,
            [

                'tel.required' => 'Le champ téléphone est obligatoire.',
                'num_correspondant.required' => 'Le champ numéro du correspondant est obligatoire.',
                'email.required' => 'Le champ email est obligatoire.',
                'doc_bac.required' => 'Le document du bac est obligatoire.',
                'nni.required' => 'Le document NNI est obligatoire.',
                'cert_medical.required' => 'Le certificat médical est obligatoire.',
                'photo.required' => 'La photo est obligatoire.',
                'capture_paiement.required' => 'La capture de paiement est obligatoire.',
            ]


        );
        $bachelier = BachelierOrientation::findOrFail($bachelierID);
        $bachelier->tel = $request->input('tel');
        // numero correspondant
        $bachelier->num_correspondant = $request->input('num_correspondant');
        $bachelier->email = $request->input('email');
        if($bachelier->inscription == 3 || $bachelier->inscription == 4)
            $bachelier->inscription = 2;
        $bachelier->email= $request->input('email');
        $bachelier->num_correspondant = $request->input('num_correspondant');

        // créer un dossier pour le bachelier dans app/bacheliers
        $bachelierDir = storage_path('app/bacheliers/temp-' . $bachelier->id);
        if (!File::exists($bachelierDir)) {

            File::makeDirectory($bachelierDir, 0755, true);
        }
        else{
            // supprimer le contenu du dossier
            File::cleanDirectory($bachelierDir);
        }

        // gerer les documents

        if ($request->hasFile('doc_bac')) {
            $path = $request->file('doc_bac');
            $newPath = $bachelierDir . '/doc_bac.' . $request->file('doc_bac')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        // nni
        if ($request->hasFile('nni')) {
            $path = $request->file('nni');
            $newPath = $bachelierDir . '/nni.' . $request->file('nni')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        if ($request->hasFile('cert_medical')) {
            $path = $request->file('cert_medical');
            $newPath = $bachelierDir . '/cert_medical.' . $request->file('cert_medical')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        // photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo');
            $newPath = $bachelierDir . '/photo.' . $request->file('photo')->getClientOriginalExtension();
            File::move($path, $newPath);
        }

        // capture_paiement
        if ($request->hasFile('capture_paiement')) {
            $path = $request->file('capture_paiement');
            $newPath = $bachelierDir . '/capture_paiement.' . $request->file('capture_paiement')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        $bachelier->save();
        return view('inscriptions.reponse_bachelier', compact('bachelier'));
    }

    // update inscription d'un etudiant
    public function update(Request $request, $etudiantID)
    {
        // valider les données
        $request->validate([
            'tel' => 'required|string|max:15',
            'num_correspondant' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'nni' => 'required|file|max:2048',
            'capture_paiement' => 'required|file|max:2048', // max 2MB
            'attestation_reussite' => 'required|file|max:2048', // max 2MB
            'photo' => 'required|image|max:2048', // max 2MB
        ],
        [
            'tel.required' => 'Le champ téléphone est obligatoire.',
            'num_correspondant.required' => 'Le champ numéro du correspondant est obligatoire.',
            'email.required' => 'Le champ email est obligatoire.',
            'nni.required' => 'Le document NNI est obligatoire.',
            'capture_paiement.required' => 'La capture de paiement est obligatoire.',
            'attestation_reussite.required' => 'L\'attestation de réussite est obligatoire.',
            'photo.required' => 'La photo est obligatoire.',
        ]
    );
        $etudiant = Etudiant::findOrFail($etudiantID);
        $etudiant->telephone = $request->input('tel');
        // numero correspondant
        $etudiant->num_correspondant = $request->input('num_correspondant');
        $etudiant->email = $request->input('email');
        if($etudiant->inscription == 3 || $etudiant->inscription == 4)
            $etudiant->inscription = 2;
        // créer un dossier pour l'étudiant dans app/etudiants
        $etudiantDir = storage_path('app/etudiants/temp-' . $etudiant->id);
        if (!File::exists($etudiantDir)) {
            File::makeDirectory($etudiantDir, 0755, true);
        } else {
            // supprimer le contenu du dossier
            File::cleanDirectory($etudiantDir);
        }

        // gerer les documents
        if ($request->hasFile('nni')) {
            $path = $request->file('nni');
            $newPath = $etudiantDir . '/nni.' . $request->file('nni')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        // nni
        if ($request->hasFile('capture_paiement')) {
            $path = $request->file('capture_paiement');
            $newPath = $etudiantDir . '/capture_paiement.' . $request->file('capture_paiement')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        if ($request->hasFile('attestation_reussite')) {
            $path = $request->file('attestation_reussite');
            $newPath = $etudiantDir . '/attestation_reussite.' . $request->file('attestation_reussite')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        //photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo');
            $newPath = $etudiantDir . '/photo.' . $request->file('photo')->getClientOriginalExtension();
            File::move($path, $newPath);
        }
        $etudiant->save();
        // créer le session etudiant_id
        session(['etudiant_id' => $etudiant->id]);
        if ($etudiant->inscription == 2 || $etudiant->inscription == 3) {
            return view('inscriptions.reponse_etudiant', compact('etudiant'));
        }
        else{
            return view('inscriptions.reponse_etudiant', compact('etudiant'));
        }
    }

}

