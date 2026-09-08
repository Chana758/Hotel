<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class BookingController extends Controller
{
    /**
     * 1. Display the booking list for the Admin (Admin Dashboard)
     */
    public function index()
    {
        // Use with(['user', 'room']) to fetch data from other tables faster if needed (Eager Loading)
        $bookings = Booking::all();
        
        return view('admin.view_booking', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all(); // Fetch all rooms so the admin can select them in the form
        return view('admin.add_booking', compact('rooms'));
    }

    public function save_booking(Request $request)
    {
        // 1. Thorough Validation
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after:startDate',
        ]);

        // 2. Overlap Booking Check
        // Ensure that admin manual bookings do not conflict with online bookings
        $isBooked = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->startDate)
                      ->where('end_date', '>=', $request->startDate);
                })->orWhere(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->endDate)
                      ->where('end_date', '>=', $request->endDate);
                });
            })->exists();

        if ($isBooked) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This room is already booked for the selected dates! Please choose another date or room.');
        }

        // 3. Create booking data
        $data = new Booking();
        $data->room_id = $request->room_id;
        
        // Capture the ID of the currently logged-in admin and store it in user_id
        if(Auth::id()) {
            $data->user_id = Auth::id();
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->start_date = $request->startDate;
        $data->end_date = $request->endDate;
        
        // Set status to Approved immediately since the guest is present at the location
        $data->status = 'approved'; 
        
        $data->save();

        // Redirect back to the booking list with a success message
        return redirect()->route('admin.view_bookings')->with('message', 'The walk-in booking was added successfully!');
    }

    /**
     * 2. Store room booking data (Store Booking)
     */
    public function store(Request $request, $id)
    {
        // 1. Define data validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after:startDate',
        ]);

        // 2. Important Logic: Check if the room has overlapping bookings for these dates
        // Search for bookings with the same room_id and conflicting date ranges
        $isBooked = Booking::where('room_id', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Case: The new start date falls within an existing booking range
                    $q->where('start_date', '<=', $request->startDate)
                      ->where('end_date', '>=', $request->startDate);
                })->orWhere(function ($q) use ($request) {
                    // Case: The new end date falls within an existing booking range
                    $q->where('start_date', '<=', $request->endDate)
                      ->where('end_date', '>=', $request->endDate);
                })->orWhere(function ($q) use ($request) {
                    // Case: The new booking completely covers an existing booking
                    $q->where('start_date', '>=', $request->startDate)
                      ->where('end_date', '<=', $request->endDate);
                });
            })->exists();

        // 3. If there is an overlap, return an error message to the user
        if ($isBooked) {
            return redirect()->back()
                ->withInput() // Retain input data so it doesn't get lost in the form
                ->with('error', 'This room is already booked for the selected dates. Please choose another date.');
        }

        // 4. If there is no overlap, save to the database
        $data = new Booking();
        $data->room_id = $id;

        if(Auth::id()) {
            $data->user_id = Auth::id();
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->start_date = $request->startDate;
        $data->end_date = $request->endDate;

        $data->save();

        return redirect()->back()->with('message', 'Your room booking was successful!');
    }   

    public function edit_booking($id)
    {
        $booking = Booking::find($id);
        $rooms = Room::all(); // So they can change the room if desired
        return view('admin.edit_booking', compact('booking', 'rooms'));
    }

    public function update_booking(Request $request, $id)
    {
        // 1. Validate all fields
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'status' => 'required'
        ]);

        // 2. Check for overlapping bookings (Overlap Check)
        // Exclude the current record itself (where('id', '!=', $id))
        $isBooked = Booking::where('room_id', $request->room_id)
            ->where('id', '!=', $id) 
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->startDate)
                    ->where('end_date', '>=', $request->startDate);
                })->orWhere(function ($q) use ($request) {
                    $q->where('start_date', '<=', $request->endDate)
                    ->where('end_date', '>=', $request->endDate);
                });
            })->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'This room is already booked for these new selected dates!');
        }

        // 3. Update all data
        $data = Booking::find($id);
        $data->room_id = $request->room_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->start_date = $request->startDate;
        $data->end_date = $request->endDate;
        $data->status = $request->status;
        
        $data->save();

        return redirect()->route('admin.view_bookings')->with('message', 'The booking information was updated successfully!');
    }

    // Approve a booking
    public function approve_booking($id)
    {
        $booking = Booking::find($id);
        
        if ($booking) {
            $booking->status = 'approved'; // Change status in DB
            $booking->save();
            return redirect()->back()->with('message', 'The booking has been approved successfully!');
        }
        return redirect()->back()->with('error', 'Booking data not found!');
    }

    // Reject a booking
    public function reject_booking($id)
    {
        $booking = Booking::find($id);
        
        if ($booking) {
            $booking->status = 'rejected'; // Change status in DB
            $booking->save();
            return redirect()->back()->with('message', 'The booking has been rejected successfully!');
        }
        return redirect()->back()->with('error', 'Booking data not found!');
    }

    /**
     * 3. Delete a booking (Delete Booking)
     */
    public function destroy($id)
    {
        $data = Booking::find($id);
        
        if ($data) {
            $data->delete();
            return redirect()->back()->with('message', 'The booking data has been deleted!');
        }

        return redirect()->back()->with('error', 'Booking data not found!');
    }
}