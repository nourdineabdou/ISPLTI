<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmballagesProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('emballages_produits')->insert([
            ['product_id' => 1, 'emballage_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'emballage_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'emballage_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            // Add more entries as needed
        ]);
    }
}
