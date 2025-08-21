<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code_module',
        'lib_module_ar',
        'lib_module_fr',
        'etat_suppression',
        'nb_heure',
    ];
}

