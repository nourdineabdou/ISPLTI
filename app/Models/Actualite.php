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
        'lien',
        'fichier',
        'statut',
    ];
}
