<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentParticipant extends Model
{
    protected $table = 'tournament_participants';

    protected $fillable = [
        'tournament_id',
        'participant_id',
        'participant_type',
        'is_confirmed'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }

    public function participant()
    {
        return $this->morphTo();
    }
}
