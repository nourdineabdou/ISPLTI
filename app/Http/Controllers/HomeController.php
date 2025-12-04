<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\AnneeUniversitaire;
use App\Models\InscriptionAdm;
use App\Models\Etablissement;
use App\Models\Auth\User;
// profoesseur
use App\Models\Professeur;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// actualite
use App\Models\Actualite;
use App\Models\ProfesseurEducation;
use App\Models\ProfesseurLanguage;
use App\Models\ProfesseurExperience;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()

    {
        // nom profosseur
        // ahmed
        // ms
        // medabdallahi
        // sdmed
        // abdrahman
        // meddah
        // mohamdi
        // abs.vall
        // ghoulam
        // soumare


        // $roleProfesseur = Role::firstOrCreate(['name' => 'Professeur']);
        // $user = User::find(384);
        // $user->assignRole([$roleProfesseur->id]);

        // $etudiant =  User::firstOrCreate(['email' => 'Etudiant@gmail.com'], [
        //     'name' => 'Etudiant',
        //     'email' => 'Etudiant@gmail.com',
        //     'password' => bcrypt('password')
        // ]);
        // // recuperer les permissions des étudiants
        // $permissions = Permission::whereIn("id", [32, 33, 34, 35, 36 , 37, 38, 39, 40, 41,42,43,44])->pluck('id', 'id')->all();
        // $roleEtudiant = Role::firstOrCreate(['name' => 'Etudiant']);
        // $roleEtudiant->syncPermissions($permissions);
        // $etudiant->assignRole([$roleEtudiant->id]);
        // // crrer user professeur
        // $professeur = User::firstOrCreate(['email' => 'Professeur@gmail.com'], [
        //     'name' => 'Professeur',
        //     'email' => 'Professeur@gmail.com',
        //     'password' => bcrypt('password')
        // ]);
        // // recuperer les permissions des professeurs
        // $permissions = Permission::whereIn("id", [45, 46, 47, 48, 49, 50, 51, 52, 53, 54])->pluck('id', 'id')->all();
        // $roleProfesseur = Role::firstOrCreate(['name' => 'Professeur']);
        // $roleProfesseur->syncPermissions($permissions);
        // $professeur->assignRole([$roleProfesseur->id]);
        if (auth()->check()) {
            if (auth()->user()->hasRole('Etudiant')) {
                $etudiant=Etudiant::where('user_id',auth()->user()->id)->get()->first();
                $ndos=substr($etudiant->nodos,-4);
                $inscrit=InscriptionAdm::where('annee_univ_id',$this->anneeActive()->id)->where('etudiant_id',$etudiant->id)->get();
                $inscritEtat=0;
                if($inscrit->count()>0){
                        $inscritEtat=1;
                }
                return view('espace_etudiant', ['etudiant'=>$etudiant,'ndos'=>$ndos,'inscritEtat'=>$inscritEtat,'anneeActive'=>$this->anneeActive()] );
            } elseif (auth()->user()->hasRole('Professeur')) {
                $professeur=Professeur::where('user_id',auth()->user()->id)->get()->first();
                $professeurEducations = ProfesseurEducation::where('professeur_id', $professeur->id)->get();
                $professeurExperiences = ProfesseurEducation::where('professeur_id', $professeur->id)->get();

                $professeurLanguages = ProfesseurLanguage::where('professeur_id', $professeur->id)->get();
                return view('espace_professeur' , [
                    'professeur'=>$professeur,
                    'professeurEducations' => $professeurEducations,
                    'professeurExperiences' => $professeurExperiences,
                    'professeurLanguages' => $professeurLanguages
                ]);
            }
        }
        return view('admin_espace');
    }
    public function anneeActive(){
         $annee=AnneeUniversitaire::where('etat',1)->get()->first();
        return $annee;
    }
    public function page()
    {
        // dernieres actualites et son etat publiée
         $news=Actualite::latest()->where('statut','publie')->take(1)->first();
        return view('school',['news'=>$news]);
    }


}
