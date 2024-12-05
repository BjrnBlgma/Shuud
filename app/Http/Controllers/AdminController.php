<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        if (!auth()->user()) {
            return redirect('/login');
        }elseif (!User::with('role')->get('role_id') == 'Администратор') {
                 return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для добавления поста.');
        }
        $allPosts = Post::with('user', 'post_types', 'images')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }

    public function showCreatePostForm(Request $request)
    {
        $section = $request->input('section');
        $postType = PostType::find($section);
        $user = auth()->user();
        return view('admin.createPost', compact('section', 'postType', 'user'));
    }

    public function submitPost(Request $request)
    {

    }
}
