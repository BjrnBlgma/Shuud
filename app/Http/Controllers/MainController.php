<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showMainPage()
    {
        $postWithImages = Post::with('postFile.file')->get();
        $posts = $postWithImages->sortByDesc('created_at')->take(6);
//        $posts = Post::with('images')->get()->sortByDesc('created_at')->take(3);
        return view('main', compact('posts'));
    }

    public function showAboutPage()
    {
        return view('aboutFBShT');
    }
}
