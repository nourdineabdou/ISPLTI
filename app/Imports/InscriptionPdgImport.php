<?php

namespace App\Imports;

// Etudiant;
use App\Models\Etudiant;
// semestre
// specialite
// annee_univ
use App\Models\Semestre;
use App\Models\Specialite;
use App\Models\AnneeUniversitaire;
// module
// matiere

use App\Models\Module;

use App\Models\InscriptionPdg;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InscriptionPdgImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $etudiant = Etudiant::where('nodos', $row['id_etudiant'])->first();
        if($etudiant) {
            return new InscriptionPdg([
                'etudiant_id' => $etudiant->id,
                'semestre_id' => Semestre::where('semestre_code', trim($row['code_semestre']))->value('id') ?? null,
                'specialite_id' => Specialite::where('annee_diplome_id', trim($row['code_specialite']))->value('id') ?? null,
                'annee_univ_id' => AnneeUniversitaire::where('etat',1)->value('id') ?? null,
                'matiere_id' => $row['matiere_id'] ?? null,
                'module_id' => Module::where('code_module', trim($row['code_module']))->value('id') ?? null,
                'element_id' => $row['id_element'] ?? null,
                'nb_inscription' => $row['nb_inscription'] ?? 1,
                'annee_premiere_attribution' => $row['annee_premiere_attribution'] ?? null,
                'credit' => $row['credit'] ?? null,
                'nb_heure' => $row['nb_heure'] ?? null,
            ]);
        }
    }




}
