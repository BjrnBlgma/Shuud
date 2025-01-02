<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Guest;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Http\Request;
use App\Enums\TournamentParticipantStatus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TournamentParticipantController extends Controller
{
    public function showAddAthleteForm($tournament_id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        $tournamentId = $tournament_id;
        return view('admin.tournament.registerGuestFromAdmin', compact('tournamentId', 'user'));  // вьюшка унивесальная
    }

    public function showAllAthletes($tournament_id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
//            $tournament = Tournament::with('tournamentParticipants.participant')->findOrFail($tournament_id);  //тоже работает код
        $tournament = Tournament::with(['tournamentParticipants' => function ($query) {
            $query->where('is_confirmed', true)->orderBy('id', 'asc');
        }])->findOrFail($tournament_id);
        $user = auth()->user();
        return view('admin.tournament.participantsTable', compact('tournament', 'user'));
    }

    public function showApplications($tournament_id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $tournament = Tournament::with(['tournamentParticipants.participant' => function ($query) {
            $query->orderBy('participant_id', 'asc')->orderBy('is_confirmed', 'desc');
        } ])->findOrFail($tournament_id);
        $user = auth()->user();

        return view('admin.tournament.listOfApplications', compact('tournament', 'user'));
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

        DB::beginTransaction();
        try {
            $guest = Guest::create($validated);

            TournamentParticipant::create([
                'tournament_id'=> $validated['tournament_id'],
                'participant_id'=> $guest->id,
                'participant_type'=> get_class($guest),
                'is_confirmed' => true,
                'status' => TournamentParticipantStatus::AWAITING_CONFIRMATION
            ]);
            DB::commit();

            return redirect()->route('info-tournament', $validated['tournament_id'])->with('success', 'Участник успешно добавлен!');
        } catch (\Exception $exception) {
            DB::rollBack();
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка: ' . $exception->getMessage()])->withInput();
        }
    }

    public function allowToTournament($tournament_id, $participant_id)
    {
        $participant = TournamentParticipant::where('tournament_id', $tournament_id)
            ->where('participant_id', $participant_id)
            ->firstOrFail();
        if (!empty($participant)){
            $participant->update([
                'is_confirmed' => true ,
                'status' => TournamentParticipantStatus::AWAITING_CONFIRMATION
                ]);

            if (empty($participant->uuid)) {
                $participant->update(['uuid' => (string) Str::uuid()]);
            }

            $data = [
                'name' => "{$participant->participant->surname} {$participant->participant->name}",
                'link' => route('confirm', ['uuid' => $participant->uuid]),
                ];

            Mail::send(['text' => 'mail'], $data, function ($message) use ($participant) {
                $message->to($participant->participant->email, $participant->participant->surname . ' ' . $participant->participant->name)
                    ->subject('Вы допущены к участию!');
                $message->from('info@shuud.ru', 'Президент ФБШ-Т Очиров Дагба');
            });

            return redirect()->route('tournament-applications', ["tournament_id" => $tournament_id])->with('success', 'Участник допущен к участию!');
        }
        return back()->withErrors(['error' => 'Произошла ошибка'])->withInput();
    }

    public function denyToParticipate($tournament_id, $participant_id)
    {
        $participant = TournamentParticipant::where('tournament_id', $tournament_id)
            ->where('participant_id', $participant_id)
            ->firstOrFail();
        if (!empty($participant)){
            $participant->update([
                'is_confirmed' => false,
                'status' => null,
                'uuid' => null,
            ]);
            return redirect()->route('tournament-applications', ["tournament_id" => $tournament_id])->with('success', 'Участник не допущен к участию!');
        }
        return back()->withErrors(['error' => 'Произошла ошибка'])->withInput();
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
