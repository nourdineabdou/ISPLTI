<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semestre extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'semestre_code',
        'lib_semestre_ar',
        'lib_semestre_fr',
        'credit_total',
        'etat_suppression',
        'niveau',
        'etat',
    ];
}

