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
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $allPosts = Post::with('user', 'postType', 'postFile.file')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }



    private function isAdmin()
    {
        if (!auth()->user()) {
            return false;
        }
        $user = auth()->user();
        if ($user->role_id === 1 || $user->role_id === 2 || $user->role_id === 11) {
            return true;
        }
        return false;
    }
}
