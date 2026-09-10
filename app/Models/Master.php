<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $table = 'masters';

    protected $fillable = [
        'code',
        'intitule',
        'intitule_ar',
        'intitule_en',
        'annee_universitaire',
        'campus',
        'description',
        'description_ar',
        'description_en',
        'date_debut_candidature',
        'date_fin_candidature',
        'statut',
    ];

    protected $casts = [
        'statut' => 'boolean',
        'date_debut_candidature' => 'date',
        'date_fin_candidature' => 'date',
    ];

    public function candidatures()
    {
        return $this->hasMany(CandidatureMaster::class, 'master_id');
    }

    public function piecesObligatoires()
    {
        return $this->hasMany(PieceObligatoireMaster::class, 'master_id')->orderBy('ordre');
    }

    public function intituleLocalise($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'ar' && !empty($this->intitule_ar)) {
            return $this->intitule_ar;
        }

        if ($locale === 'en' && !empty($this->intitule_en)) {
            return $this->intitule_en;
        }

        return $this->intitule;
    }

    public function descriptionLocalisee($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'ar' && !empty($this->description_ar)) {
            return $this->description_ar;
        }

        if ($locale === 'en' && !empty($this->description_en)) {
            return $this->description_en;
        }

        return $this->description;
    }
}
