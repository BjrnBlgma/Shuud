<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('Images', 'public');

            $image = new Image();
            $image->post_id = $request->post_id;
            $image->image = $path;
            $image->save();

            return back()->with('success', 'Image uploaded successfully');
        }
        return back()->with('error', 'Image upload failed, try again later');
    }
}
