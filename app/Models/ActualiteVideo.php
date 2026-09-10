<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualiteVideo extends Model
{
    protected $table = 'actualite_videos';

    protected $fillable = [
        'actualite_id',
        'chemin',
        'ordre',
    ];

    public function actualite()
    {
        return $this->belongsTo(Actualite::class);
    }
}
