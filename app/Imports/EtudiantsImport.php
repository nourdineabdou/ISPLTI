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
             'nodos'=> $row[0],
            'nom_ar'    => $row[1],
            'nom_fr'     => $row[2],
            'lieu_naissance_ar' => $row[3],
            'lieu_naissance_fr' => $row[4],
            'date_naissance' => $row[5],
            'genre' => $row[6],
            'telephone' => $row[7],
            'situation_familiale_id' => $row[8],
            'nationalite' => $row[9],
            'etat_bourse' => $row[10],
            'date_ajout' => $row[11],
            'date_maj' => $row[12],
            'personnel_id' => $row[13],
            'adresse' => $row[14],
            'nni' => $row[15],
            'etablissement_id' => $row[16],
            'email' => $row[17],
            'annee_entree_etabliss' => $row[18],
            'num_derogation' => $row[19],
            'date_derogation' => $row[20],
            'inscription' => $row[21],
            'num_correspondant' => $row[22],
            'actif' => $row[23],
        ]);
    }
}
