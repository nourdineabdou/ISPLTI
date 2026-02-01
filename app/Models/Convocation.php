<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'matrucle',
        'jour',
        'matiere',
        'specialite',
        'semestre',
        'tauxpresecce',
        'nosalle',
        'horaire',
        'date',
    ];
}
