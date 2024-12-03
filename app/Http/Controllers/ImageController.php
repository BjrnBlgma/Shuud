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
//            $filePath = $request->file('image')->store('public/Images');

            $image = new Image();

            $image->post_id = $request->post_id;
            $image->image = $path;
//            $image->image = str_replace('public/', '', $filePath);

            $image->save();



            return back()->with('success', 'Image uploaded successfully');
        }
        return back()->with('error', 'Image upload failed, try again later');
    }
}
