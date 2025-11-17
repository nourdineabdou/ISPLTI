<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'nom',
        'telephone',
        'prenom',
        'cv',
        'image',
        'specialite',
        'nni'
    ];
    public function educations()
    {
        return $this->hasMany(ProfesseurEducation::class , 'professeur_id');
    }
    public function experiences()
    {
        return $this->hasMany(ProfesseurExperience::class, 'professeur_id');
    }
    public function languages()
    {
        return $this->hasMany(ProfesseurLanguage::class, 'professeur_id');
    }


    // PdfProfe relation
    public function pdfProfes()
    {
        return $this->hasMany(PdfProfe::class);
    }
}
