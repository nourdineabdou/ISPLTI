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

        $user = User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Cheikh Ahmed Aloueimin',
            'email' => 'super-admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::firstOrCreate(['email' => 'user@gmail.com'], [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);



        $role = Role::firstOrCreate(['name' => 'Super Admin']);

        Role::firstOrCreate(['name' => 'User']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
