<?php

namespace App\Http\Controllers;
use App\Enums\TournamentParticipantStatus;
use Illuminate\Support\Facades\DB;

use App\Models\Guest;
use App\Models\TournamentParticipant;
use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Str;
use App\Enums\TournamentStatus;
use Illuminate\Validation\Rule;


class GuestController extends Controller
{
    public function showRegistrationGuestForm($tournament_id, $registration_token)
    {
        $tournament = Tournament::where('id', $tournament_id)->where('registration_token', $registration_token)->firstOrFail();

        if (!$tournament) {
            abort(404, 'Турнир не найден или регистрация закрыта.');
        }
        if ($tournament->status == TournamentStatus::UPCOMING) {
            abort(403, "Регистрация начинается за 2 дня до начала турнира!");
        }
        if ($tournament->status !== TournamentStatus::REGISTRATION) {
            abort(403, 'Регистрация на этот турнир закрыта.');
        }

        return view('admin.tournament.registerGuestBySelf', compact('tournament'));
    }

    public function registerGuest(Request $request, $tournament_id, $registration_token)
    {
        $tournament = Tournament::where('id', $tournament_id)->where('registration_token', $registration_token)->firstOrFail();
        if (!$tournament) {
            abort(404, 'Турнир не найден или регистрация закрыта.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tournament_id' => 'required|integer|exists:tournaments,id' /*required|integer|max:255*/
        ]);
        DB::beginTransaction();
        try {
            $guest = Guest::create( $validated);

            TournamentParticipant::create([
                'tournament_id'=> $tournament_id,
                'participant_id'=> $guest->id,
                'participant_type'=> get_class($guest),
                'is_confirmed' => false,
            ]);
            DB::commit();

            return redirect()->route('success.page')->with('success', 'Вы успешно зарегистрировались на турнир!');
        } catch (\Exception $exception) {
            DB::rollBack();
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении поста: ' . $exception->getMessage()])->withInput();
        }
    }

    public function confirmParticipation($uuid)
    {
        $tournamentParticipant = TournamentParticipant::where('uuid', $uuid)->firstOrFail();

        $tournamentParticipant->status = 'participating';
        $tournamentParticipant->save();

        return view('admin.tournament.confirm', compact('tournamentParticipant'));
    }

    public function cancelParticipation($uuid)
    {
        $tournamentParticipant = TournamentParticipant::where('uuid', $uuid)->firstOrFail();

        $tournamentParticipant->status = 'withdrawing_from_tournament';
        $tournamentParticipant->save();

        // Возвращаем страницу отмены
        return view('admin.tournament.cancel', compact('tournamentParticipant'));
    }
}
