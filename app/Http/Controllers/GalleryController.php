<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use File; 

class GalleryController extends Controller
{
    // 1. Display the gallery page and fetch all images to show
    public function view_gallery()
    {
        $gallery = Gallery::all();
        return view('admin.view_gallery', compact('gallery'));
    }

    // 2. Receive the image, save it in the folder, and store the file name in the database
    public function upload_gallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Gallery;
        $image = $request->image;

        if($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            // Save in public/gallery
            $request->image->move('gallery', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back()->with('message', 'Image uploaded successfully!');
    }

    // 3. Delete the image record from the database and remove the actual file from the public/gallery folder
    public function delete_gallery($id)
    {
        $data = Gallery::find($id);
        
        if ($data) {
            // Delete the actual image file
            $path = public_path('gallery/'.$data->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $data->delete();
        }

        return redirect()->back()->with('message', 'Image deleted from the system successfully!');
    }
}