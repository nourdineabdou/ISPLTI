<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PieceObligatoireMaster extends Model
{
    protected $table = 'pieces_obligatoires_master';

    protected $fillable = [
        'master_id',
        'code_document',
        'libelle',
        'obligatoire',
        'ordre',
        'actif',
    ];

    protected $casts = [
        'obligatoire' => 'boolean',
        'actif' => 'boolean',
    ];

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    /**
     * Le libelle est stocke en base en francais uniquement (colonne unique, non
     * traduite). On le remplace par la traduction connue pour ce code_document
     * quand elle existe (fr/en/ar), sinon on garde le libelle brut de la base -
     * ce qui couvre aussi une piece ajoutee manuellement par l'admin avec un
     * code_document inconnu du fichier de traduction.
     */
    public function libelleLocalise(): string
    {
        $cle = 'candidature.piece_' . $this->code_document;

        return \Illuminate\Support\Facades\Lang::has($cle) ? __($cle) : $this->libelle;
    }
}
