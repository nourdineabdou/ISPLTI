<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Kilograme',
                'symbol' => 'kg'
            ],
            [
                'name' => 'Grame',
                'symbol' => 'g'
            ],
            [
                'name' => 'Litre',
                'symbol' => 'l'
            ],
            [
                'name' => 'Millilitre',
                'symbol' => 'ml'
            ],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate([
                'name' => $unit['name']
            ],[
                'symbol' => $unit['symbol']
            ]);
        }
    }
}
