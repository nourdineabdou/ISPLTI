<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    protected $table = 'entretiens';

    protected $fillable = [
        'candidature_id',
        'date_entretien',
        'mode',
        'lieu',
        'statut',
        'note',
        'observation',
    ];

    protected $casts = [
        'date_entretien' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
