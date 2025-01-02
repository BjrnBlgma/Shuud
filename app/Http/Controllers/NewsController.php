<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function showNews()
    {
        $postWithImages = Post::with('postFile.file')->get();
        $posts = $postWithImages->sortByDesc('created_at');
//        $posts = Post::with('images')->get()->sortByDesc('created_at')->take(3);
        return view('news', compact('posts'));
    }

    public function showPost($id)
    {
        $post = Post::with('postFile.file')->findOrFail($id);
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
            'post_type_id' => 'required|integer|max:255',
            'image' => 'required|array', // Проверяем, что пришёл массив
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Проверка каждого изображения
        ]);
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'author_id' => $validated['author_id'],
                'post_type_id' => $validated['post_type_id'],
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $imageFile) {
                    $path = $imageFile->store('Images', 'public');
                    if (!$path) { // Проверяем, успешно ли сохранён файл
                        throw new \Exception('Ошибка при сохранении файла.');
                    }
                    $image = File::create([
                        'path' => $path,
                    ]);

                    PostFile::create([
                        'post_id' => $post->id,
                        'file_id' => $image->id,
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('news')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }
}
