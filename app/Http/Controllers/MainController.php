<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showMainPage()
    {
        $postWithImages = Post::with('files')->get();
        $posts = $postWithImages->sortByDesc('created_at')->take(3);
//        $posts = Post::with('images')->get()->sortByDesc('created_at')->take(3);
        return view('main', compact('posts'));
    }
}
