<?php
namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Traits\Upload;

class FileController extends Controller
{
    use Upload;//add this trait

    public function store(Request $request)
    {
        $file_details = [];
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                $path = $this->UploadFile($file, 'public');

                array_push($file_details,[
                    'path' => $path,
                ]);
            }
            foreach ($file_details as $key => $value) {
                File::create($value);
            }
            $file_details = [];
        }
    }
}
