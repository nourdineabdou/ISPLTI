<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = Role::firstOrCreate(['name' => 'Admin']);
        // role etudiant
        //$roleEtudiant = Role::firstOrCreate(['name' => 'Etudiant']);
        // role professeur
        //$roleProfesseur = Role::firstOrCreate(['name' => 'Professeur']);


        $user = User::firstOrCreate(['email' => 'nourdine@gmail.com'], [
            'name' => 'nourdine',
            'email' => 'nourdine@gmail.com',
            'password' => bcrypt('nour3631')
        ]);

        User::firstOrCreate(['email' => 'user@gmail.com'], [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);

        $etudiant =  User::firstOrCreate(['email' => 'Etudiant@gmail.com'], [
            'name' => 'Etudiant',
            'email' => 'Etudiant@gmail.com',
            'password' => bcrypt('password')
        ]);

        // recuperer les permissions des étudiants
        $permissions = Permission::whereIn("id", [32, 33, 34, 35, 36 , 37, 38, 39, 40, 41,42,43,44])->pluck('id', 'id')->all();
        $roleEtudiant = Role::firstOrCreate(['name' => 'Etudiant']);
        $roleEtudiant->syncPermissions($permissions);
        $etudiant->assignRole([$roleEtudiant->id]);

        // crrer user professeur
        $professeur = User::firstOrCreate(['email' => 'Professeur@gmail.com'], [
            'name' => 'Professeur',
            'email' => 'Professeur@gmail.com',
            'password' => bcrypt('password')
        ]);
        // recuperer les permissions des professeurs
        $permissions = Permission::whereIn("id", [45, 46, 47, 48, 49, 50, 51, 52, 53, 54])->pluck('id', 'id')->all();
        $roleProfesseur = Role::firstOrCreate(['name' => 'Professeur']);
        $roleProfesseur->syncPermissions($permissions);
        $professeur->assignRole([$roleProfesseur->id]);


        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
