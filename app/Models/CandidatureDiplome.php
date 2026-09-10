<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatureDiplome extends Model
{
    use SoftDeletes;

    protected $table = 'candidature_diplomes';

    protected $fillable = [
        'candidature_id',
        'type_diplome',
        'intitule',
        'domaine',
        'specialite',
        'etablissement',
        'pays',
        'annee_obtention',
        'mention',
        'fichier_diplome',
        'fichier_releve',
        'fichier_memoire',
        'fichier_rapport',
        'fichier_projet_fin_etudes',
        'certifie_conforme',
    ];

    protected $casts = [
        'certifie_conforme' => 'boolean',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
