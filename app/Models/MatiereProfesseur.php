<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatiereProfesseur extends Model
{
    use SoftDeletes;

    protected $table = 'matiereprofesseurs';

    protected $fillable = [
        'professeur_id',
        'matiere_id',
        'code_specialite',
        'active',
        'libelle',
        'nbreEtudiant',
    ];

    /**
     * Relation avec Professeur
     */
    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    /**
     * Relation avec Matiere
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    /**
     * Relation avec Specialité (si tu as un modèle)
     */
    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'code_specialite', 'id');
    }
}
