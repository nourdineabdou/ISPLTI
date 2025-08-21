<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lib_etab_ar',
        'lib_etab_fr',
        'code_etab_ar',
        'code_etab_fr',
        'pres_fix',
        'dernier_num_etud',
        'dernier_num_etudfc',
        'nbr_semestres_autorise_progression',
        'nbr_credit_autorise_progression',
        'nbr_modules_autorise_progression',
        'utiliser_groupe_immatriculation',
        'longueur_nodos',
        'etat_suppression',
        'paiement_frais_par_master',
        'utilise_seul_manuel',
        'nbre_autorise_manuel',
        'signature_chef_scolarite',
        'nom_chef_scolarite_ar',
        'nom_chef_scolarite_fr',
        'progression_master_annuel_au_semestriel',
        'nbrecu',
        'nbr_recu_br',
        'nbr_recu_brcns',
    ];
}

