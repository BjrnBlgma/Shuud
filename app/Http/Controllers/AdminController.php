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
    public function showAdminPage()
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $allPosts = Post::with('user', 'postType', 'files')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.admin', compact('allPosts', "user"));
    }

    public function showAllTournaments()
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $allCompetitions = Tournament::with('user')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('admin.competitionsList', compact('allCompetitions', "user"));
    }

    public function showCreatePostForm(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $section = $request->input('section');
        $postType = PostType::find($section);
        $user = auth()->user();
        return view('admin.createPost', compact('section', 'postType', 'user'));
    }

    public function submitPost(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'post_type_id' => 'required|integer|max:255',
            'image' => 'required|array', // Проверяем, что пришёл массив
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Проверка каждого изображения
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
                    foreach ($request->file('image') as $imageFile) {
                        $path = $imageFile->store('Images', 'public');
                        if (!$path) { // Проверяем, успешно ли сохранён файл
                            throw new \Exception('Ошибка при сохранении файла.');
                        }
                        File::create([
                            'post_id' => $post->id,
                            'image' => $path,
                        ]);
                    }
                }
            });

            return redirect()->route('admin')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении поста: ' . $exception->getMessage()])->withInput();
        }
    }

    public function showAddTournamentForm()
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $user = auth()->user();
        return view('admin.addTournament', compact('user'));
    }

    public function addTournament(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
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
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $post = Post::with('files')->findOrFail($id);
        return view('admin.editPost', compact('post'));
    }

    public function deletePost($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }
        $post = Post::with(['files'])->findOrFail($id);
        $post->delete();
        return redirect()->route('admin')->with('success', "Пост успешно удален!");
    }

    public function updatePost(Request $request, $id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('checkAuth');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_images' => 'nullable|string'
        ]);

        try {
            DB::transaction(function () use ($validated, $request, $id) {
                $post = Post::findOrFail($id);
                $post->update([
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'author_id' => $validated['author_id'],
                ]);

                // Обработка удаления изображений
                $deletedImageIds = json_decode($request->input('deleted_images', '[]'), true);
                if (!empty($deletedImageIds)) {
                    // Находим и удаляем конкретные изображения
                    $imagesToDelete = File::whereIn('id', $deletedImageIds)->where('post_id', $post->id)->get();

                    foreach ($imagesToDelete as $imageFile) {
                        // Удаляем файл из хранилища
                        if (Storage::disk('public')->exists($imageFile->image)) {
                            Storage::disk('public')->delete($imageFile->image);
                        }
                        // Удаляем запись из базы данных
                        $imageFile->delete();
                    }
                }

                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $imageFile) {
                        $path = $imageFile->store('Images', 'public');
                        if (!$path) { // Проверяем, успешно ли сохранён файл
                            throw new \Exception('Ошибка при сохранении файла.');
                        }
                        File::create([
                            'post_id' => $post->id,
                            'image' => $path,
                        ]);
                    }
                }
            });

            return redirect()->route('admin')->with('success', 'Новость успешно отредактирована!');
        } catch (\Exception $exception) {
//            \Log::error('Ошибка обновления поста: ' . $exception->getMessage());
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }


    private function isAdmin()
    {
        if (!auth()->user()) {
            return false;
        } else {
            $user = auth()->user();
            $admin = User::with("role")->findOrFail($user->id);
            if ($admin->role->name !== 'Администратор') {
                return false;
            }
        }
        return true;
    }
}
