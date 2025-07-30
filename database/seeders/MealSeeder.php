<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\MealCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $meals = [
            [
                'name' => 'SALADE ROYAL GRILL',
                'description' => 'laitue - avocat - oeufs - tomate - haricot rouge - surimi - crevettes grillées - oignon rouge',
                'price' => 400,
                'image' => 'meals/salade-royal-grill.jpg',
                'meal_category_id' => 1,
            ],
            [
                'name' => 'SALADE EXOTIQUE',
                'description' => 'mangue - ananas - tomate - blanc de poulet grillé - choux fleur - oignon rouge - choux rouge',
                'price' => 400,
                'image' => 'meals/salade-exotique.jpg',
                'meal_category_id' => 1,
            ],
            [
                'name' => 'NEMS VIANDE',
                'description' => '',
                'price' => 300,
                'image' => 'meals/nems-viande.jpg',
                'meal_category_id' => 1,
            ],
            [
                'name' => 'Steak Grillé en Escabiche',
                'description' => '',
                'price' => 550,
                'image' => 'meals/steak-grille-en-escabiche.jpg',
                'meal_category_id' => 2,
            ],
            [
                'name' => 'Côte de Boeuf aux èpices d’orient',
                'description' => '',
                'price' => 500,
                'image' => 'meals/cote-de-boeuf-aux-epices-d-orient.jpg',
                'meal_category_id' => 2,
            ],
            [
                'name' => 'Merguez martiniquaise',
                'description' => '',
                'price' => 300,
                'image' => 'meals/merguez-martiniquaise.jpg',
                'meal_category_id' => 2,
            ],
            [
                'name' => 'Côtelette',
                'description' => '',
                'price' => 580,
                'image' => 'meals/cotelette.jpg',
                'meal_category_id' => 3,
            ],
            [
                'name' => 'Gigot',
                'description' => '',
                'price' => 550,
                'image' => 'meals/gigot.jpg',
                'meal_category_id' => 3,
            ],
            [
                'name' => 'Entrecôte laquée lucullus',
                'description' => '',
                'price' => 480,
                'image' => 'meals/entrecote-laquee-lucullus.jpg',
                'meal_category_id' => 3,
            ],
            [
                'name' => 'Dibi d’agneau printanier',
                'description' => '',
                'price' => 500,
                'image' => 'meals/dibi-d-agneau-printanier.jpg',
                'meal_category_id' => 3,
            ],
            [
                'name' => 'Côtelette',
                'description' => '',
                'price' => 560,
                'image' => 'meals/cotelette.jpg',
                'meal_category_id' => 4,
            ],
            [
                'name' => 'Gigot',
                'description' => '',
                'price' => 520,
                'image' => 'meals/gigot.jpg',
                'meal_category_id' => 4,
            ],
            [
                'name' => 'Poulet en deux cuissons à l’ancienne',
                'description' => '',
                'price' => 250,
                'image' => 'meals/poulet-en-deux-cuissons-a-l-ancienne.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => '1/2 Poulet',
                'description' => '',
                'price' => 450,
                'image' => 'meals/1-2-poulet.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Poulet complet',
                'description' => '',
                'price' => 300,
                'image' => 'meals/poulet-complet.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Chicken wings',
                'description' => '',
                'price' => 280,
                'image' => 'meals/chicken-wings.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Poulet en deux cuissons à l’ancienne',
                'description' => '',
                'price' => 250,
                'image' => 'meals/poulet-en-deux-cuissons-a-l-ancienne.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => '1/2 Poulet',
                'description' => '',
                'price' => 450,
                'image' => 'meals/1-2-poulet.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Poulet complet',
                'description' => '',
                'price' => 300,
                'image' => 'meals/poulet-complet.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Chicken wings',
                'description' => '',
                'price' => 280,
                'image' => 'meals/chicken-wings.jpg',
                'meal_category_id' => 5,
            ],
            [
                'name' => 'Thiof',
                'description' => '',
                'price' => 450,
                'image' => 'meals/thiof.jpg',
                'meal_category_id' => 6,
            ],
            [
                'name' => 'Daurade',
                'description' => '',
                'price' => 550,
                'image' => 'meals/daurade.jpg',
                'meal_category_id' => 6,
            ],
            [
                'name' => 'Filet de Capitaine',
                'description' => '',
                'price' => 600,
                'image' => 'meals/filet-de-capitaine.jpg',
                'meal_category_id' => 6,
            ],
            [
                'name' => 'Gambas Grillées',
                'description' => '',
                'price' => 850,
                'image' => 'meals/gambas-grillees.jpg',
                'meal_category_id' => 6,
            ],
            [
                'name' => 'Langouste Grillé',
                'description' => '',
                'price' => 450,
                'image' => 'meals/langouste-grille.jpg',
                'meal_category_id' => 6,
            ],
            [
                'name' => 'Spaghetti Bolognaise',
                'description' => '',
                'price' => 980,
                'image' => 'meals/spaghetti-bolognaise.jpg',
                'meal_category_id' => 7,
            ],
            [
                'name' => 'Tagliatelle aux fruits de mer',
                'description' => '',
                'price' => 300,
                'image' => 'meals/tagliatelle-aux-fruits-de-mer.jpg',
                'meal_category_id' => 7,
            ],
            [
                'name' => 'Assiette du Pêcheur',
                'description' => '',
                'price' => 550,
                'image' => 'meals/assiette-du-pecheur.jpg',
                'meal_category_id' => 7,
            ],
            [
                'name' => 'Tagliatelle Poulet sauce crème champignon',
                'description' => '',
                'price' => 350,
                'image' => 'meals/tagliatelle-poulet-sauce-creme-champignon.jpg',
                'meal_category_id' => 7,
            ],
            [
                'name' => 'Emincèe de Boeuf à l’indienne',
                'description' => '',
                'price' => 400,
                'image' => 'meals/emincee-de-boeuf-a-l-indienne.jpg',
                'meal_category_id' => 8,
            ],
            [
                'name' => 'Emincée de Poulet',
                'description' => '',
                'price' => 400,
                'image' => 'meals/emincee-de-poulet.jpg',
                'meal_category_id' => 8,
            ],
        ];

        foreach ($meals as $meal) {
            Meal::firstOrCreate([
                'name' => $meal['name'],
            ], [
                'description' => $meal['description'],
                'price' => $meal['price'],
                'image' => $meal['image'],
                'meal_category_id' => $meal['meal_category_id'],
            ]);
        }
    }
}
