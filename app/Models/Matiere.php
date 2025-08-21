<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matiere extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lib_element_ar',
        'lib_element_fr',
        'etat_suppression',
        'etablissement_id',
        'departement_id',
    ];

    // Relations
    public function specialites()
    {
        return $this->hasMany(MatiereSpecialite::class);
    }
}

