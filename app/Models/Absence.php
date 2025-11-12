<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'absences';  // Spécifie le nom de la table si elle est différente de la convention plurielle
    protected $primaryKey = 'id';  // Spécifie la clé primaire si ce n'est pas 'id'
    public $timestamps = true;  // Permet de gérer les timestamps (created_at, updated_at)

    protected $fillable = [
        'matrucle', 'jour', 'matiere', 'specialite', 'semestre',
        'semaine', 'horaire', 'date'
    ];

    // Si vous ne voulez pas que certaines colonnes soient mass-assignables, vous pouvez utiliser $guarded :
    // protected $guarded = ['id'];

    // Si vous voulez manipuler les dates (comme la colonne "date" dans votre table), vous pouvez aussi faire ceci :
    protected $dates = ['date', 'created_at', 'updated_at', 'deleted_at']; // Dates de type Carbon
}


