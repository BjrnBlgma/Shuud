<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showAdminPageAndAllNews()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $allPosts = Post::with('user', 'postType', 'images')->where('post_type_id', 1)->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }

    public function showAllTournaments()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $allPosts = Post::with('user', 'postType', 'images')->where('post_type_id', 2)->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }

    public function showCreatePostForm(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $section = $request->input('section');
        $postType = PostType::find($section);
        $user = auth()->user();
        return view('admin.createPost', compact('section', 'postType', 'user'));
    }

    public function submitPost(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'post_type_id' => 'required|integer|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            return redirect()->route('admin')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }

    public function showAddTournamentForm()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        return view('admin.addTournament', compact('user'));
    }

    public function addTournament(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'created_user_id' => 'required|integer|max:255',
            'status' => 'required|string|max:255',
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

    public function showEditPostForm($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $post = Post::with('images')->findOrFail($id);
        return view('admin.editPost', compact('post'));
    }

    public function deletePost($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        Post::with(['images'])->findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', "Пост успешно удален!");
    }

    public function updatePost(Request $request, $id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login');
        }
        $post = Post::with('images')->findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            DB::transaction(function () use ($validated, $request, $id) {
                $post = Post::with('images')->findOrFail($id);
                $post->update([
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'author_id' => $validated['author_id'],
                ]);

                if ($request->hasFile('images')) {
                    $post->images()->delete();

                    foreach ($request->file('images') as $imageFile) {
                        $path = $imageFile->store('Images', 'public');
                        $post->images()->create([
                            'post_id' => $post->id,
                            'image' => $path,
                        ]);
                    }
                }
            });

            return redirect()->route('admin')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }


    private function isAdmin()
    {
        $user = auth()->user();
        if ($user->role->name !== 'Администратор') {
            return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для добавления поста.');
        }
        return true;
    }
}
