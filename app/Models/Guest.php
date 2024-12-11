<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';

    protected $fillable = [
        'name',
        'surname',
        'region',
        'city',
        'phone',
        'email',
    ];

    public function tournamentParticipant()
    {
        return $this->morphMany(TournamentParticipant::class, 'participant');
    }
}
