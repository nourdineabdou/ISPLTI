<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissionsDir = app_path('permissions');

        $permissionFiles = glob($permissionsDir . '/*.php');

        $allPermissions = [];

        foreach ($permissionFiles as $file) {

            $permissions = include($file);

            $allPermissions = array_merge($allPermissions, $permissions);
        }

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
