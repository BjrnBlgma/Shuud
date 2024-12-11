<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function showInfoAboutTournamentAndEditFormPage($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        $tournament = Tournament::with('user', 'tournamentParticipants')->find($id);
        return view('admin.tournament.infoAboutTournament', compact('user', 'tournament'));
    }

    public function updateTournament(Request $request, $id)
    {

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
            'status' => 'required|in:upcoming,registration of athletes,active,completed',
        ]);
        Tournament::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'],
            'created_user_id' => $validated['created_user_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin')->with('success', 'Новость успешно добавлена!');
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
