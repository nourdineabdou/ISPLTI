<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeEmballagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_emballages')->insert([
            ['nom' => 'Boîte', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Sac', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Bouteille', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Barquette', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Poche', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Bocal', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Film plastique', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Carton', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
