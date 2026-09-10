<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormationCandidat extends Model
{
    use SoftDeletes;

    protected $table = 'formations_candidat';

    protected $fillable = [
        'candidature_id',
        'intitule',
        'organisme',
        'domaine',
        'date_debut',
        'date_fin',
        'certificat',
        'description',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
