<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceProfesseur extends Model
{
    use HasFactory;

    protected $table = 'compétences_professeurs'; // à cause de l'accent

    protected $fillable = [
        'professeur_id',
        'libelle',
        'niveau',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
