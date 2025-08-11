<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auth\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
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
                return view('espace_etudiant');
            } elseif (auth()->user()->hasRole('Professeur')) {
                return view('espace_professeur');
            }
        }
        return view('admin_espace');
    }
    public function page()
    {
        return view('school');
    }

}
