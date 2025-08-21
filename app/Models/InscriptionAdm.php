<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InscriptionAdm extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'etudiant_id',
        'semestre_id',
        'specialite_id',
        'annee_univ_id',
        'groupe_id',
        'date_inscription',
        'date_maj',
        'etat_etudiant_id',
        'type_paiement_id',
        'type_inscription_id',
        'carte_imprimer',
        'personnel_id',
    ];

    // Relations
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}

