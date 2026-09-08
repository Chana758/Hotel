<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $select_room = Room::all();
          
        return view('admin.view_room', compact('select_room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $select_room = Room::all();
        // In Laravel, using compact('variable_name') is a popular and easy method 
        // to pass data from a Controller to a Blade view.
        // It packs the variable into an array with matching keys and values 
        // so that Blade can recognize and use it.
        return view('admin.create_room', compact('select_room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_title' => 'required|unique:rooms,room_title',
            'description' => 'required',
            'price' => 'required|numeric',
            'room_type' => 'required',
            'wifi' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
        ]);
        
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('Room', $fileName, 'public');
            $fileUrl = asset('storage/Room/' . $fileName);  
        }

        Room::create([
            'room_title' => $request->room_title,
            'description' => $request->description,
            'price' => $request->price,
            'room_type' => $request->room_type,
            'wifi' => $request->wifi,
            'image' => $fileUrl,
        ]);
        
        return redirect()->route('admin.view_room')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.update_room', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        
        $request->validate([
            'room_title' => 'required|unique:rooms,room_title,' . $room->id,
            'description' => 'required',
            'price' => 'required|numeric',
            'room_type' => 'required',
            'wifi' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
        ]);

        // Save old image URL before update
        $oldImage = $room->image;
        
        // Update room details
        $room->room_title = $request->room_title;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->room_type = $request->room_type;
        $room->wifi = $request->wifi;

        // Delete old image if a new image is uploaded
        if ($request->hasFile('image')) {
            if ($oldImage) {
                $oldImagePath = 'Room/' . basename($oldImage);
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
            
            // Upload new image
            $file = $request->file('image');
            $newName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('Room', $newName, 'public');
            $newUrl = asset('storage/Room/' . $newName);
            $room->image = $newUrl;
        }
            
        $room->save();
        
        return redirect()->route('admin.view_room')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        
        if ($room) {
           if ($room->image) {
                $fileName = 'Room/' . basename($room->image);
                Storage::disk('public')->delete($fileName);
            }
        }
        
        $room->delete();
        
        return redirect()->route('admin.view_room')->with('success', 'Room deleted successfully.');
    }
}