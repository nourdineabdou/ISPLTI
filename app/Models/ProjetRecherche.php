<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjetRecherche extends Model
{
    use SoftDeletes;

    protected $table = 'projets_recherche';

    protected $fillable = [
        'candidature_id',
        'titre',
        'discipline',
        'resume',
        'fichier_projet',
        'nombre_pages',
        'date_depot',
        'statut',
        'note',
        'observation',
    ];

    protected $casts = [
        'date_depot' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
