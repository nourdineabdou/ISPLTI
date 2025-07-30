<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Http\Traits\TracksActions;
class Caisse extends Model
{
    use SoftDeletes,TracksActions;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Auth\User::class , 'created_by');
    }

    public function temporaires(): HasMany
    {
        return $this->hasMany(\App\Models\Temporaire::class , 'caisse_id');
    }

    const TYPE_RESTAURANT = 'restaurant';
    const TYPE_CSS = 'CSS';
    const TYPE_RESIDENCE = 'residence ';
     // cette fonction retourne les types de caisse un collection cle valeur
    public static function getTypeOptions()
    {
        return collect([
            [ "id"=> 'restaurant' , 'name'=> 'Restaurant'],
            [ "id"=> 'CSS' , 'name'=> 'CSS'],
            [ "id"=> 'residence' , 'name'=> 'Residence'],
        ]);
    }


}
