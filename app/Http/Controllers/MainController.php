<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showMainPage()
    {
        $posts = Post::with('images')->get()->sortByDesc('created_at')->take(3);
        return view('main', compact('posts'));
    }
}
