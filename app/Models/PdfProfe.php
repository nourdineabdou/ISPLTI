<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfProfe extends Model
{

    use HasFactory;

    protected $table = 'pdf_profes';

    protected $fillable = [
        'matiere_id',
        'specialite_id',
        'chemain_pde',
        'active',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }
}
