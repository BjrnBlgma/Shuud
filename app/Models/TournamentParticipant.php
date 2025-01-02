<?php

namespace App\Models;
use App\Enums\TournamentParticipantStatus;

use Illuminate\Database\Eloquent\Model;

class TournamentParticipant extends Model
{
    protected $table = 'tournament_participants';

    protected $fillable = [
        'tournament_id',
        'participant_id',
        'participant_type',
        'is_confirmed',
        'status',
        'uuid'
    ];

    protected $casts = [
        'status' => TournamentParticipantStatus::class, // Автоматически приводим к Enum
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }

    public function participant()
    {
        return $this->morphTo();
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            TournamentParticipantStatus::PARTICIPATING => 'Участвую',
            TournamentParticipantStatus::WITHDRAWING_FROM_TOURNAMENT => 'Снимаюсь с турнира',
            TournamentParticipantStatus::AWAITING_CONFIRMATION => 'Еще не решил(а)',
            TournamentParticipantStatus::STANDBY => 'На замену, если кто-то откажется',
            TournamentParticipantStatus::UNAVAILABLE_FOR_PARTICIPATION => 'Не смогу участвовать по уважительной причине',
            TournamentParticipantStatus::REQUESTING_A_DELAY => 'Прошу отсрочку (для случаев, если участник хочет временно подержать за собой место - актуально в турнирах с жёсткой сеткой)',
            TournamentParticipantStatus::REQUESTING_CHANGES => 'Запрашиваю изменение данных'
        };
    }
}
