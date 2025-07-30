<?php

namespace Database\Seeders;

use App\Models\MealCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mealCategories = [
            [
                'id' => 1,
                'name' => 'Nos entrees',
                'description' => 'Nos entrees',
            ],
            [
                'id' => 2,
                'name' => 'Nos viandes en grillades',
                'description' => 'Nos viandes en grillades',
            ],
            [
                'id' => 3,
                'name' => 'Agneau en grillades',
                'description' => 'Agneau en grillades',
            ],
            [
                'id' => 4,
                'name' => 'Cabri en grillades',
                'description' => 'Cabri en grillades',
            ],
            [
                'id' => 5,
                'name' => 'Volailles',
                'description' => 'Volailles',
            ],
            [
                'id' => 6,
                'name' => 'Poissons et fruits de mer',
                'description' => 'Poissons et fruits de mer',
            ],
            [
                'id' => 7,
                'name' => 'Nos pattes',
                'description' => 'Nos pattes',
            ],
            [
                'id' => 8,
                'name' => 'Plats chauds',
                'description' => 'Plats chauds',
            ],
            [
                'id' => 9,
                'name' => 'Fast food',
                'description' => 'Fast food',
            ],
            [
                'id' => 10,
                'name' => 'Nos plateaux mix (idéales pour 2 à 3 personnes)',
                'description' => 'Nos plateaux mix (idéales pour 2 à 3 personnes)',
            ],
            [
                'id' => 11,
                'name' => 'Nos mégas mix ( idéales pour 5 à 8 personnes )',
                'description' => 'Nos mégas mix ( idéales pour 5 à 8 personnes )',
            ],
            [
                'id' => 12,
                'name' => 'Desserts',
                'description' => 'Desserts',
            ],
            [
                'id' => 13,
                'name' => 'Glaces',
                'description' => 'Glaces',
            ],
            [
                'id' => 14,
                'name' => 'Jus',
                'description' => 'Jus',
            ],
            [
                'id' => 15,
                'name' => 'Boissons chaudes',
                'description' => 'Boissons chaudes',
            ],
            [
                'id' => 16,
                'name' => 'Milshake',
                'description' => 'Milshake',
            ],
            [
                'id' => 17,
                'name' => 'Mojitos',
                'description' => 'Mojitos',
            ],
            [
                'id' => 18,
                'name' => 'Cocktails',
                'description' => 'Cocktails',
            ],
            [
                'id' => 19,
                'name' => 'Smoothies',
                'description' => 'Smoothies',
            ],

        ];

        foreach ($mealCategories as $mealCategory) {
            MealCategory::firstOrCreate([
                'id' => $mealCategory['id'],
                'name' => $mealCategory['name'],
                'description' => $mealCategory['description'],
            ]);
        }
    }
}
