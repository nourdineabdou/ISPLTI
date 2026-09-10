<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class EvaluationCandidature extends Model
{
    protected $table = 'evaluations_candidature';

    protected $fillable = [
        'candidature_id',
        'evaluateur_id',
        'note_dossier',
        'note_diplome',
        'note_langues',
        'note_projet_recherche',
        'note_motivation',
        'note_experience',
        'note_entretien',
        'note_finale',
        'decision',
        'observation',
        'date_evaluation',
    ];

    protected $casts = [
        'date_evaluation' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }

    public function evaluateur()
    {
        return $this->belongsTo(User::class, 'evaluateur_id');
    }
}
