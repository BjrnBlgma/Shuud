<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Enums\TournamentStatus;
use Illuminate\Validation\Rule;

class TournamentController extends Controller
{
    public function showAllTournaments()
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $allCompetitions = Tournament::with('user', 'tournamentParticipants')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.tournament.tournamentsTable', compact('allCompetitions', "user"));
    }

    public function showInfoAboutTournament($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        $tournament = Tournament::with('user', 'tournamentParticipants')->find($id);
        return view('admin.tournament.infoAboutTournament', compact('user', 'tournament'));
    }

    public function showAddTournamentForm()
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        return view('admin.tournament.addTournament', compact('user'));
    }


    public function addTournament(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'created_user_id' => 'required|integer|max:255',
            'status' => ['required', Rule::in(array_column(TournamentStatus::cases(), 'value'))],
        ]);
        Tournament::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'],
            'created_user_id' => $validated['created_user_id'],
            'status' => TournamentStatus::from($validated['status']),
            'registration_token' =>  Str::uuid(),
        ]);

        return redirect()->route('tournaments-list')->with('success', 'Турнир успешно добавлен!');
    }

    public function showEditTournamentForm($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        $tournament = Tournament::findOrFail($id);
        return view('admin.tournament.editTournament', compact('tournament', 'user'));
    }

    public function updateTournament(Request $request, $id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(array_column(TournamentStatus::cases(), 'value'))],
        ]);
        $tournament = Tournament::findOrFail($id);
        $tournament->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'],
            'status' => TournamentStatus::from($validated['status']),
            'updated_at' => now()
        ]);
        $tournament->save();
        return redirect()->route('tournaments-list')->with('success', 'Турнир успешно добавлен!');
    }

    public function generateRegistrationLink($tournament_id)
    {
        $tournament = Tournament::findOrFail($tournament_id);

        if (!empty($tournament->registration_token)) {
            return redirect()->back()->with('error', 'Ссылка уже сгенерирована!');
        }

        $tournament->registration_token = Str::uuid();
        $tournament->save();

        return redirect()->back()->with('success', 'Ссылка успешно создана!');
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
