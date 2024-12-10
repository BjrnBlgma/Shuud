<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showAdminPageAndAllPosts()
    {
        if ($this->isAdmin()){
            return redirect()->route('main');
        }
        $allPosts = Post::with('user', 'postType', 'postFile.file')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }

    public function showAllTournaments()
    {
        if ($this->isAdmin()){
            return redirect()->route('main');
        }
        $allCompetitions = Tournament::with('user')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.competitionsList', compact('allCompetitions', "user"));
    }


    private function isAdmin()
    {
        if (!auth()->user()) {
            return false;
        } else {
            $user = auth()->user();
            $admin = User::with("role")->findOrFail($user->id);
            if ($admin->role->name !== 'Администратор' || $admin->role->name !== 'Суперадминистратор'){
                return false;
            }
        }
        return true;
    }
}
