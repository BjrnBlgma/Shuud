<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\TournamentParticipant;
use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function showRegistrationGuestForm($tournament_id, $registration_token)
    {
        $tournament = Tournament::where('id', $tournament_id)->where('registration_token', $registration_token)->firstOrFail();

        if (!$tournament) {
            abort(404, 'Турнир не найден или регистрация закрыта.');
        }
        if ($tournament->status !== 'registration_of_athletes') {
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
        try {
            $guest = Guest::create( $validated);

            TournamentParticipant::create([
                'tournament_id'=> $tournament_id,
                'participant_id'=> $guest->id,
                'participant_type'=> get_class($guest),
                'is_confirmed' => false,
            ]);

            return redirect()->route('success.page')->with('success', 'Вы успешно зарегистрировались на турнир!');
        } catch (\Exception $exception) {
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении поста: ' . $exception->getMessage()])->withInput();
        }
    }
}
