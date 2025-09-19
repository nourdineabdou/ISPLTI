<?php

namespace App\Imports;

use App\Models\BachelierOrientation;
use Maatwebsite\Excel\Concerns\ToModel;

class BacheliersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BachelierOrientation([
            // excel columns
             'bachelier_id'=> $row[0],
            'nom_ar'    => $row[1],
            'nom_fr'     => $row[2],
            'datn' => $row[3],
            'lieun' => $row[4],
            'lieuna' => $row[5],
            'num_bac' => $row[6],
            'serie_id' => $row[7],
            'centre_examen' => $row[8],
            'centre_scolorisation' => $row[9],
            'session_bac' => $row[10],
            'type_candidat' => $row[11],
            'annee_bac' => $row[12],
            'moyenne_bac_g1' => $row[13],
            'moyenne_bac_g2' => $row[14],
            'moyenne_bac' => $row[15],
            'profil_orientation' => $row[16],
            'lib_profil_orientation' => $row[17],
            'etab_profil_orientation' => $row[18],
            'genre' => $row[19],
            'nni' => $row[20],
            'tel' => $row[21],
            'inscription' => $row[22],
            'email' => $row[23],
            'num_correspondant' => $row[24],
        ]);
    }
}
