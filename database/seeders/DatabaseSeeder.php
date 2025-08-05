<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionTableSeeder::class,
            RoleAndPermissionSeeder::class,
        ]);
    }
}
