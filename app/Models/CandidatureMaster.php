<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatureMaster extends Model
{
    use SoftDeletes;

    protected $table = 'candidatures_master';

    protected $fillable = [
        'master_id',
        'numero_candidature',
        'token',
        'token_expire_at',
        'mot_de_passe',
        'nom',
        'prenom',
        'sexe',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'nni',
        'telephone',
        'whatsapp',
        'email',
        'adresse',
        'situation_professionnelle',
        'profession',
        'organisme_employeur',
        'experience_professionnelle',
        'experience_recherche',
        'statut',
        'date_soumission',
        'commentaire_admin',
    ];

    protected $hidden = [
        'mot_de_passe',
        'token',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_soumission' => 'datetime',
        'token_expire_at' => 'datetime',
        'mot_de_passe' => 'hashed',
    ];

    public function tokenEstExpire(): bool
    {
        return !$this->token_expire_at || now()->greaterThan($this->token_expire_at);
    }

    public function estActivee(): bool
    {
        return !empty($this->mot_de_passe);
    }

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    public function diplomes()
    {
        return $this->hasMany(CandidatureDiplome::class, 'candidature_id');
    }

    public function langues()
    {
        return $this->hasMany(CandidatureLangue::class, 'candidature_id');
    }

    public function documents()
    {
        return $this->hasMany(DocumentCandidature::class, 'candidature_id');
    }

    public function entretiens()
    {
        return $this->hasMany(Entretien::class, 'candidature_id');
    }

    public function evaluations()
    {
        return $this->hasMany(EvaluationCandidature::class, 'candidature_id');
    }

    public function experiencesProfessionnelles()
    {
        return $this->hasMany(ExperienceProfessionnelle::class, 'candidature_id');
    }

    public function formations()
    {
        return $this->hasMany(FormationCandidat::class, 'candidature_id');
    }

    public function lettreMotivation()
    {
        return $this->hasOne(LettreMotivation::class, 'candidature_id');
    }

    public function notifications()
    {
        return $this->hasMany(NotificationCandidature::class, 'candidature_id');
    }

    public function projetsRecherche()
    {
        return $this->hasMany(ProjetRecherche::class, 'candidature_id');
    }
}
