<?php

namespace App\Models;

use App\Enums\TournamentStatus;            // Подключаем Enum
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table = 'tournaments';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location',
        'created_user_id',
        'status',
        'registration_token',
    ];

    protected $casts = [
        'status' => TournamentStatus::class,    // Кастим поле "status" к Enum
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function tournamentFiles()
    {
        return $this->hasMany(TournamentFile::class, 'tournament_id');
    }

    public function tournamentParticipants()
    {
        return $this->hasMany(TournamentParticipant::class, 'tournament_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            TournamentStatus::UPCOMING => 'Запланирован',
            TournamentStatus::REGISTRATION => 'Регистрация спортсменов',
            TournamentStatus::ACTIVE => 'Активен',
            TournamentStatus::COMPLETED => 'Завершён',
            TournamentStatus::CANCELLED => 'Отменен',
        };
    }
}
