<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualiteImage extends Model
{
    protected $table = 'actualite_images';

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
