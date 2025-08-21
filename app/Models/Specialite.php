<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'annee_diplome_id',
        'diplome_id',
        'niveau',
        'lib_annee_diplome_ar',
        'lib_annee_diplome_fr',
        'total_credit',
        'option_an_diplome',
        'annee_univ_id',
        'etat_suppression',
        'session',
        'etablissement_id',
        'montant_frais',
        'semestre',
    ];

    public function anneeUniv()
    {
        return $this->belongsTo(AnneeUniv::class, 'annee_univ_id');
    }

    public function diplome()
    {
        return $this->belongsTo(Diplome::class, 'diplome_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id');
    }
}
