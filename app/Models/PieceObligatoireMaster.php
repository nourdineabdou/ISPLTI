<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PieceObligatoireMaster extends Model
{
    protected $table = 'pieces_obligatoires_master';

    protected $fillable = [
        'master_id',
        'code_document',
        'libelle',
        'obligatoire',
        'ordre',
        'actif',
    ];

    protected $casts = [
        'obligatoire' => 'boolean',
        'actif' => 'boolean',
    ];

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }
}
