<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
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

    public function getNodosSuffixAttribute()
    {
        $nodos = (string) $this->nodos;

        if ($nodos === '') {
            return '';
        }

        if (str_contains($nodos, '/')) {
            $parts = explode('/', $nodos);
            return trim((string) end($parts));
        }

        return trim($nodos);
    }

    public function getAvailableBulletins(array $semestres = ['S1', 'S3', 'S5' , 'S2', 'S4', 'S6'])
    {
        $suffix = $this->nodos_suffix;

        if ($suffix === '') {
            return [];
        }

        $available = [];

        foreach ($semestres as $semestre) {
            $semestre = strtoupper((string) $semestre);
            $fileName = $suffix . $semestre . '.png';
            $path = 'S1S3S5/' . $fileName;
            $path2 = 'S2S4S6/' . $fileName;

            if (Storage::disk('local')->exists($path) || Storage::disk('local')->exists($path2)) {

                $available[$semestre] = [
                    'semestre' => $semestre,
                    'filename' => $fileName,
                    'path' => Storage::disk('local')->exists($path) ? $path : $path2,
                ];
            }
        }
        return $available;
    }
}
