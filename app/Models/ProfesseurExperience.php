<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesseurExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'professeur_id',
        'job_title',
        'institution',
        'start_date',
        'end_date',
        'responsibilities',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
