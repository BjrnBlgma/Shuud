<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('Images', 'public');

            $image = new Image();
            $image->post_id = $request->post_id;
            $image->image = $path;
            $image->save();

            return redirect()->route('news')->with('success', 'Новость успешно добавлена!');
        }
        return back()->with('error', 'Image upload failed, try again later');
        // ошибка была из-за того, что я не добавила enctype="multipart/form-data" в форму отправки во вьюшке:(
    }

    public function showCreateImageForm()
    {
        return view("fileUploads");
    }
}
