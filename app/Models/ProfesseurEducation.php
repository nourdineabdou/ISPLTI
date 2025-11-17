<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesseurEducation extends Model
{
    protected $table = 'professeur_educations';

    protected $fillable = [
        'professeur_id',
        'degree',
        'institution',
        'start_year',
        'end_year',
        'description',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
