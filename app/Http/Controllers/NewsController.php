<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function showNews()
    {
        $postWithImages = Post::with('images')->get();
        $posts = $postWithImages->sortByDesc('created_at');
//        $posts = Post::with('images')->get()->sortByDesc('created_at')->take(3);
        return view('news', compact('posts'));
    }

    public function showPost($id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('post', compact('post'));
    }


    public function showCreatePostForm()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для добавления поста.');
        }
        $userId = htmlspecialchars(auth()->id(), ENT_QUOTES, 'UTF-8');
        return view('createPost', compact('userId'));
    }

    public function createPost(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для добавления поста.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'post_type_id' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            DB::transaction(function () use ($validated, $request) {
                $post = Post::create([
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'author_id' => $validated['author_id'],
                    'post_type_id' => $validated['post_type_id'],
                ]);

                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('Images', 'public');

                    Image::create([
                        'post_id' => $post->id,
                        'image' => $path,
                    ]);
                }
            });

            return redirect()->route('news')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }
}