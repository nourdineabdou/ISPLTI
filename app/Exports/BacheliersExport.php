<?php

namespace App\Exports;


use App\Models\BachelierOrientation;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;      // Mémoire-friendly
use Maatwebsite\Excel\Concerns\WithHeadings;   // Entêtes
use Maatwebsite\Excel\Concerns\WithMapping;    // Sélection/ordre des colonnes
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Colonnes auto
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BacheliersExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public function query(): Builder
    {
        return BachelierOrientation::query();
    }

     public function headings(): array
    {
        return [
            'Nom AR',      // أوّل عمود
            'Nom FR',
            'Date de naissance',
            'lieu de naissance',
            'Lieu de naissance FR',
            'numéro bac',
            'serie ID',
            'Centre examen',
            'centre de scolorisation',
            "Session bac",
            'Type candidature',
            "annee bac",
            'moyenne bac G1',
            'moyenne bac G2',
            'moyenne bac',
            'profil oriantation',
            'libelle profil oriantation',
            'etablissement',
            'genre',
            'NNI',
            'telephone',
            'inscription',
            'email',
            'numero correspondant',
        ];
    }

     public function map($e): array
    {
        return [
            $e->nom_ar,
            $e->nom_fr,
            $e->datn,
            $e->lieun,
            $e->lieuna,
            $e->num_bac,
            $e->serie_id,
            $e->centre_examen,
            $e->centre_scolorisation,
            $e->session_bac,
            $e->type_candidat,
            $e->annee_bac,
            $e->moyenne_bac_g1,
            $e->moyenne_bac_g2,
            $e->moyenne_bac,
            $e->profil_orientation,
            $e->lib_profil_orientation,
            $e->etab_profil_orientation,
            $e->genre,
            $e->nni,
            $e->telephone,
            $e->inscription,
            $e->email,
            $e->numero_correspondant,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_YYYYMMDD2, // Date
        ];
    }
}
