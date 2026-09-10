<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';

    protected $fillable = [
        'titre_fr',
        'titre_en',
        'titre_ar',
        'contenu_fr',
        'contenu_en',
        'contenu_ar',
        'date_publication',
        'auteur',
        'image',
        'statut',
    ];

    public function images()
    {
        return $this->hasMany(ActualiteImage::class)->orderBy('ordre');
    }

    public function videos()
    {
        return $this->hasMany(ActualiteVideo::class)->orderBy('ordre');
    }

    public function fichiers()
    {
        return $this->hasMany(ActualiteFichier::class)->orderBy('ordre');
    }
}
