<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatiereSpecialite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'matiere_id',
        'elementprfl_id',
        'module_id',
        'specialite_id',
        'semestre_id',
        'annee_univ_id',
        'credit',
        'coefficient',
        'prerequis',
        'etat_suppression',
        'nb_heure',
        'h_effectuer',
        'etablissement_id',
        'indic',
        'lib_element_ang',
    ];

    // Relations
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function anneeUniv()
    {
        return $this->belongsTo(AnneeUniv::class);
    }
}
