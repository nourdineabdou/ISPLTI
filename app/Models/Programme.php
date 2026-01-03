<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programme extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'programmes';

    protected $fillable = [
        'matrucle',
        'jour',
        'matiere',
        'specialite',
        'semestre',
        'semaine',
        'horaire',
        'date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
