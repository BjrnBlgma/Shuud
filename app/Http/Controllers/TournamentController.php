<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function showAddTournamentForm()
    {
        if ($this->isAdmin()){
            return redirect()->route('main');
        }
        $user = auth()->user();
        return view('admin.addTournament', compact('user'));
    }



    public function addTournament(Request $request)
    {
        if ($this->isAdmin()){
            return redirect()->route('main');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'created_user_id' => 'required|integer|max:255',
            'status' => 'required|in:запланирован,старт регистрации спортсменов,идет жеребьёвка,завершён',
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
        } else {
            $user = auth()->user();
            $admin = User::with("role")->findOrFail($user->id);
            if ($admin->role->name !== 'Администратор' || $admin->role->name !== 'Суперадминистратор' || $admin->role->name !== 'Создатель'){
                return false;
            }
        }
        return true;
    }
}
