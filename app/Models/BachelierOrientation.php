<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BachelierOrientation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bachelier_id',
        'nom_ar',
        'nom_fr',
        'datn',
        'lieun',
        'lieuna',
        'num_bac',
        'serie_id',
        'centre_examen',
        'centre_scolorisation',
        'session_bac',
        'type_candidat',
        'annee_bac',
        'moyenne_bac_g1',
        'moyenne_bac_g2',
        'moyenne_bac',
        'profil_orientation',
        'lib_profil_orientation',
        'etab_profil_orientation',
        'genre',
        'nni',
        'tel',
        'inscription',
    ];
}

