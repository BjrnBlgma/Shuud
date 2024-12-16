<?php

namespace App\Enums;

enum TournamentStatus: string
{
    case UPCOMING = 'upcoming';
    case ACTIVE = 'active';
    case REGISTRATION = 'registration_of_athletes';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
