<?php

namespace Database\Seeders;

use App\Models\Sall;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salles = [
            [
                'type' => 'salle',
                'name' => 'Salle restaurant',
                'tables' => [
                    'Table 1',
                    'Table 2',
                    'Table 3',
                    'Table 4',
                    'Table 5',
                ]
            ],
            [
                'type' => 'vip',
                'name' => 'Salle VIP',
                'tables' => [
                    'VIP 1',
                    'VIP 2',
                    'VIP 3',
                ]
            ],
            [
                'type' => 'terrasse',
                'name' => 'Salle 3',
                'tables' => [
                    'Table 1',
                    'Table 2',
                    'Table 3',
                    'Table 4',
                    'Table 5',
                    'Table 6',
                    'Table 7',
                ]
            ],
        ];

        foreach ($salles as $sall) {
            $salle = Sall::firstOrCreate([
                'type' => $sall['type'],
                'name' => $sall['name'],
            ]);

            foreach ($sall['tables'] as $table) {
                Table::firstOrCreate([
                    'name' => $table,
                    'parent_id' => $salle->id,
                ]);
            }
        }
    }
}
