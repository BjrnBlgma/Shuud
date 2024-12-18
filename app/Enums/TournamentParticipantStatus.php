<?php

namespace App\Enums;

enum TournamentParticipantStatus: string
{
    case PARTICIPATING = 'participating';
    case WITHDRAWING_FROM_TOURNAMENT = 'withdrawing_from_tournament';
    case AWAITING_CONFIRMATION = 'awaiting_confirmation';
    case STANDBY = 'standby';
    case UNAVAILABLE_FOR_PARTICIPATION = 'unavailable_for_participation';
    case REQUESTING_A_DELAY = 'requesting_a_delay';
    case REQUESTING_CHANGES = 'requesting_changes';
    case NONE = 'null';
}
