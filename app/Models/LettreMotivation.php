<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LettreMotivation extends Model
{
    protected $table = 'lettres_motivation';

    protected $fillable = [
        'candidature_id',
        'contenu',
        'fichier',
        'signee',
        'date_depot',
    ];

    protected $casts = [
        'signee' => 'boolean',
        'date_depot' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
