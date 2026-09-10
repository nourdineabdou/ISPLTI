<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatureLangue extends Model
{
    use SoftDeletes;

    protected $table = 'candidature_langues';

    protected $fillable = [
        'candidature_id',
        'langue_id',
        'niveau',
        'type',
        'certificat_langue',
        'fichier_certificat',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'langue_id');
    }
}
