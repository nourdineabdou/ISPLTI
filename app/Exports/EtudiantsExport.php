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

class EtudiantsExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public function query(): Builder
    {
        return Etudiant::query()->select([
            'nodos','nom_fr','nom_ar','lieu_naissance_ar','lieu_naissance_fr','date_naissance','telephone','situation_familiale_id','nationalite','etat_bourse',"date_ajout",'date_maj','personnel_id','adresse','nni','etablissement_id','email','annee_entree_etabliss','num_derogation','date_derogation','inscription','num_correspondant','actif'
        ]);
    }

     public function headings(): array
    {
        return [
            'Matricule',      // أوّل عمود
            'Nom fr',
            'Nom ar',
            'Lieu de naissance fr',
            'Lieu de naissance ar',
            'Date de naissance',
            'Téléphone',
            'Situation familiale',
            'Nationalité',
            'État de bourse',
            'Date d\'ajout',
            'Date de mise à jour',
            'Personnel',
            'Adresse',
            'NNI',
            'Établissement',
            'Email',
            'Année d\'entrée',
            'Numéro de dérogation',
            'Date de dérogation',
            'Inscription',
            'Numéro de correspondant',
            'Actif',
        ];
    }

     public function map($e): array
    {
        return [
            $e->nodos,
            $e->nom_fr,
            $e->nom_ar,
            $e->lieu_naissance_fr,
            $e->lieu_naissance_ar,
            $e->date_naissance,
            $e->telephone,
            $e->situation_familiale_id,
            $e->nationalite,
            $e->etat_bourse,
            $e->date_ajout,
            $e->date_maj,
            $e->personnel_id,
            $e->adresse,
            $e->nni,
            $e->etablissement_id,
            $e->email,
            $e->annee_entree_etabliss,
            $e->num_derogation,
            $e->date_derogation,
            $e->inscription,
            $e->num_correspondant,
            $e->actif ? 'Oui' : 'Non',
        ];
    }
    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Date de naissance
            'K' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Date d'ajout
            'L' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Date de mise à jour
            'T' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Date de dérogation
        ];
    }
}
