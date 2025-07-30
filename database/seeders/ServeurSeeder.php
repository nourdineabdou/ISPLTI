<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serveurs = [
            [
                'name' => 'Serveur 1',
                'phone' => '43000506',
            ],
            [
                'name' => 'Serveur 2',
                'phone' => '36020506',
            ],
            [
                'name' => 'Serveur 3',
                'phone' => '22000506',
            ],
        ];

        foreach ($serveurs as $serveur) {
            \App\Models\Serveur::firstOrCreate($serveur);
        }
    }
}
