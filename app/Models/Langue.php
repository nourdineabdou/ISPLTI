<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $table = 'langues';

    protected $fillable = [
        'code',
        'langue',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function candidatureLangues()
    {
        return $this->hasMany(CandidatureLangue::class, 'langue_id');
    }
}
