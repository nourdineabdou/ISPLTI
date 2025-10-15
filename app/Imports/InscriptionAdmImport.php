<?php

namespace App\Imports;

use App\Models\InscriptionAdm;
// Etudiant;
use App\Models\Etudiant;
// semestre
// specialite
// annee_univ
use App\Models\Semestre;
use App\Models\Specialite;
use App\Models\AnneeUniversitaire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class InscriptionAdmImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $etudiant = Etudiant::where('nodos', trim($row['id_etudiant']))->first();
        if($etudiant) {
            return new InscriptionAdm([
                'etudiant_id' => $etudiant->id,
                'semestre_id' => Semestre::where('semestre_code', trim($row['code_semestre']))->value('id') ?? null,
                'specialite_id' => Specialite::where('annee_diplome_id', trim($row['code_specialite']))->value('id') ?? null,
                'annee_univ_id' => AnneeUniversitaire::where('etat', 1)->value('id') ?? null,

            ]);
        }
    }



    /**
     * Transform date value to proper format
     *
     * @param mixed $value
     * @return string|null
     */
    private function transformDate($value)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Si c'est déjà une date valide
            if ($value instanceof \DateTime) {
                return $value->format('Y-m-d');
            }

            // Si c'est un timestamp Excel
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
            }

            // Si c'est une chaîne de caractères
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
