<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InscriptionPdg extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'etudiant_id',
        'semestre_id',
        'specialite_id',
        'annee_univ_id',
        'matiere_id',
        'module_id',
        'nb_inscription',
        'annee_premiere_attribution',
        'credit',
        'nb_heure',
    ];

    // Relations
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

