<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = [
            ['id' => 1, 'nom' => 'Restaurant', 'type_stock' => 1,],
            ['id' => 2, 'nom' => 'évènement', 'type_stock' => 1,],
            ['id' => 3, 'nom' => 'cuisine', 'type_stock' => 2,],
            ['id' => 4, 'nom' => 'virtuelle', 'type_stock' => 3,],
        ];

        foreach ($stocks as $stock) {
            \App\Models\Stock::updateOrCreate(['id' => $stock['id']], $stock);
        }
    }
}
