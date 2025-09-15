<?php

namespace App\Imports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\ToModel;

class EtudiantsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Etudiant([
            // excel columns
             'nom'       => $row[0],
            'prenom'    => $row[1],
            'email'     => $row[2],
            'telephone' => $row[3],
        ]);
    }
}
