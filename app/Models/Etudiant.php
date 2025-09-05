<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Etudiant extends Model
{
     use SoftDeletes;
     protected $fillable = [
        'nodos',
        'user_id',
        'nom_ar',
        'nom_fr',
        'lieu_naissance_ar',
        'lieu_naissance_fr',
        'date_naissance',
        'genre',
        'telephone',
        'situation_familiale_id',
        'nationalite',
        'etat_bourse',
        'date_ajout',
        'date_maj',
        'personnel_id',
        'photo',
        'adresse',
        'nni',
        'num_bac',
        'etablissement_id',
        'email',
        'annee_entree_etabliss',
        'num_derogation',
        'date_derogation'
    ];

     public function inscriptions()
    {
        return $this->hasMany(InscriptionAdm::class, 'etudiant_id');
    }
}
