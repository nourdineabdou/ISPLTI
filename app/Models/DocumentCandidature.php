<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCandidature extends Model
{
    protected $table = 'documents_candidature';

    protected $fillable = [
        'candidature_id',
        'type_document',
        'nom_fichier',
        'chemin_fichier',
        'extension',
        'taille',
        'obligatoire',
        'valide',
        'commentaire',
        'uploaded_at',
        'validated_at',
    ];

    protected $casts = [
        'obligatoire' => 'boolean',
        'valide' => 'boolean',
        'uploaded_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
