<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceProfessionnelle extends Model
{
    use SoftDeletes;

    protected $table = 'experiences_professionnelles';

    protected $fillable = [
        'candidature_id',
        'employeur',
        'poste',
        'date_debut',
        'date_fin',
        'actuellement_en_poste',
        'description',
        'certificat_travail',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'actuellement_en_poste' => 'boolean',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
