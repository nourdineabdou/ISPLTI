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



        $role = Role::firstOrCreate(['name' => 'Admin']);
        // role etudiant
        $roleEtudiant = Role::firstOrCreate(['name' => 'Etudiant']);
        // role professeur
        $roleProfesseur = Role::firstOrCreate(['name' => 'Professeur']);


        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
