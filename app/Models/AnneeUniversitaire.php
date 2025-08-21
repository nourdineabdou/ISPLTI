<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnneeUniversitaire extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'annee_univ_id',
        'libelle_ann_univ_ar',
        'ann_univ_precedent',
        'date_debut',
        'date_fin',
        'etat',
        'etat_suppression',
        'lib_cours',
        'annee_progression',
        'indc',
    ];
}
