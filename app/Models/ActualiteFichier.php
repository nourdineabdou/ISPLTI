<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualiteFichier extends Model
{
    protected $table = 'actualite_fichiers';

    protected $fillable = [
        'actualite_id',
        'chemin',
        'nom_fr',
        'nom_ar',
        'description_fr',
        'description_ar',
        'taille',
        'ordre',
    ];

    public function actualite()
    {
        return $this->belongsTo(Actualite::class);
    }

    public function nom(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'ar' && $this->nom_ar ? $this->nom_ar : $this->nom_fr;
    }

    public function description(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'ar' && $this->description_ar ? $this->description_ar : $this->description_fr;
    }

    public function tailleLisible(): string
    {
        $taille = $this->taille;
        if ($taille >= 1048576) {
            return round($taille / 1048576, 1) . ' Mo';
        }
        if ($taille >= 1024) {
            return round($taille / 1024, 1) . ' Ko';
        }
        return $taille . ' o';
    }

    public function iconClass(): string
    {
        return match ($this->extension()) {
            'pdf' => 'bi-file-earmark-pdf-fill text-danger',
            'doc', 'docx' => 'bi-file-earmark-word-fill text-primary',
            'xls', 'xlsx' => 'bi-file-earmark-excel-fill text-success',
            'ppt', 'pptx' => 'bi-file-earmark-ppt-fill text-warning',
            'zip', 'rar' => 'bi-file-earmark-zip-fill text-secondary',
            default => 'bi-file-earmark-fill text-muted',
        };
    }

    public function extension(): string
    {
        return strtolower(pathinfo($this->chemin, PATHINFO_EXTENSION));
    }
}
