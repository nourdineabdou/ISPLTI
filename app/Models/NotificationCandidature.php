<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationCandidature extends Model
{
    protected $table = 'notifications_candidature';

    protected $fillable = [
        'candidature_id',
        'type',
        'objet',
        'message',
        'canal',
        'lu',
        'date_envoi',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'date_envoi' => 'datetime',
    ];

    public function candidature()
    {
        return $this->belongsTo(CandidatureMaster::class, 'candidature_id');
    }
}
