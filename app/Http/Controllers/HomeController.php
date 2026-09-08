<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class HomeController extends Controller
{
    // 2. Add $id into the parameters
    public function room_detail($id) 
    {
        // 3. Fetch the room data with that specific ID from the database
        $room = Room::find($id);

        // 4. Pass the data to the view
        return view('home.room_detail', compact('room'));
    }
}