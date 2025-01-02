<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Models\PostFile;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function showAddPostForm(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $section = $request->input('section');
        $postType = PostType::find($section);
        $user = auth()->user();
        return view('admin.createPost', compact('section', 'postType', 'user'));
    }

    public function addPost(Request $request)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
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

            return redirect()->route('admin')->with('success', 'Новость успешно добавлена!');
        } catch (\Exception $exception) {
            DB::rollBack();
//            \Log::error($exception->getMessage());
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении поста: ' . $exception->getMessage()])->withInput();
        }
    }


    public function showEditPostForm($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        $post = Post::with('postFile.file')->findOrFail($id);
        return view('admin.editPost', compact('post'));
    }


    public function updatePost(Request $request, $id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|integer|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_images' => 'nullable|string'
        ]);
        DB::beginTransaction();
        try {
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
                $imagesToDelete = File::whereIn('id', $deletedImageIds)
                    ->whereHas('postFiles', function ($query) use ($post) {
                        $query->where('post_id', $post->id);
                    })
                    ->get();

                foreach ($imagesToDelete as $imageFile) {
                    // Удаляем файл из хранилища
                    if (Storage::disk('public')->exists($imageFile->path)) {
                        Storage::disk('public')->delete($imageFile->path);
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
                    $image = File::create(['path' => $path]);
                    PostFile::create([
                        'post_id' => $post->id,
                        'file_id' => $image->id,
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('admin')->with('success', 'Новость успешно отредактирована!');
        } catch (\Exception $exception) {
            DB::rollBack();
//            \Log::error('Ошибка обновления поста: ' . $exception->getMessage());
            return back()->with('error', 'Произошла ошибка при сохранении поста. Попробуйте снова.');
        }
    }


    public function deletePost($id)
    {
        if (!$this->isAdmin()){
            return redirect()->route('main');
        }
        DB::transaction(function () use ($id) {
            $post = Post::with(['postFile.file'])->findOrFail($id);

            // Удаляем пост (при этом связанные записи и файлы удаляются автоматически)
            $post->delete();
        });
        return redirect()->route('admin')->with('success', "Пост успешно удален!");
    }

    private function isAdmin()
    {
        if (!auth()->user()) {
            return false;
        }
        $user = auth()->user();
        if ($user->role_id === 1 || $user->role_id === 2 || $user->role_id === 11){
            return true;
        }
        return false;
    }
}
