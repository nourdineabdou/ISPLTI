<?php

namespace App\Exports;


use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;      // Mémoire-friendly
use Maatwebsite\Excel\Concerns\WithHeadings;   // Entêtes
use Maatwebsite\Excel\Concerns\WithMapping;    // Sélection/ordre des colonnes
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Colonnes auto
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EtudiantsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public function query(): Builder
    {
        return Etudiant::query();
    }

     public function headings(): array
    {
        return [
            'Matricule',      // أوّل عمود
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Niveau',
            'Date d’inscription',
        ];
    }

     public function map($e): array
    {
        return [
            $e->matricule,
            $e->nom,
            $e->prenom,
            $e->email,
            $e->telephone,
            $e->niveau,
            optional($e->created_at)?->format('Y-m-d'),
        ];
    }
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,   // Téléphone en texte
            'G' => NumberFormat::FORMAT_DATE_YYYYMMDD2, // Date
        ];
    }
}
