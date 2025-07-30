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
            UnitSeeder::class,
            PermissionTableSeeder::class,
            RoleAndPermissionSeeder::class,

            MealCategorySeeder::class,
            MealSeeder::class,
            ProductSeeder::class,
            TableSeeder::class,
            PaymentMethodSeeder::class,
            ServeurSeeder::class,

            TypeEmballagesTableSeeder::class,
            EmballagesProduitsTableSeeder::class,

            StockSeeder::class,
        ]);
    }
}
