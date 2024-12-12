<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Http\Request;

class TournamentParticipantController extends Controller
{
    public function showAddAthleteForm($tournament_id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $tournamentId = $tournament_id;
        return view('admin.tournament.registerGuestFromAdmin', compact('tournamentId'));  // вьюшка унивесальная
    }

    public function showAllAthletes($tournament_id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
//            $tournament = Tournament::with('tournamentParticipants.participant')->findOrFail($tournament_id);
        $tournament = Tournament::with(['tournamentParticipants' => function($query) {
            $query->orderBy('id', 'asc'); // Сортировка по возрастанию id в таблице tournamentParticipants
        }])->findOrFail($tournament_id);
        return view('admin.tournament.participantsTable', compact('tournament'));
    }

    public function addAthlete(Request $request)   // создала регистацию игрока из админки, после регистрации - редиректит в админку инфы о турнире
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
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
            $guest = Guest::create($validated);

            TournamentParticipant::create([
                'tournament_id'=> $validated['tournament_id'],
                'participant_id'=> $guest->id,
                'participant_type'=> get_class($guest),
                'is_confirmed' => true,
            ]);

            return redirect()->route('info-tournament', $validated['tournament_id'])->with('success', 'Участник успешно добавлен!');
        } catch (\Exception $exception) {
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении поста: ' . $exception->getMessage()])->withInput();
        }
    }

    private function isAdmin()
    {
        if (!auth()->user()) {
            return false;
        }
        $user = auth()->user();
        if ($user->role_id === 1 || $user->role_id === 2 || $user->role_id === 11){
            return true;
        }
        return false;
    }
}
