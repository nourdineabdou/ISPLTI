<?php

namespace App\Imports;

use App\Models\Meal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class MealImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    /*public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
            Meal::firstOrCreate([
                'name' => $row[0],
                'description' => $row[1],
                'price' => $row[2],
                'image' => $row[3],
                'meal_category_id' => $row[4],
            ]);
        }
    }*/

    public function model(array $row): ?Meal
    {
//        skip the first row
        if ($row[0] === 'name') {
            return null;
        }
        return Meal::firstOrCreate([
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'image' => $row[3],
            'meal_category_id' => $row[4],
        ]);
    }
}
