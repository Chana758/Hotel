<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking; 
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Gallery;
use Mail;
use App\Mail\SendEmailManager;

class AdminController extends Controller
{
    public function index()
    {   
        // Check if the user is logged in
        if (Auth::check()) {
            // Retrieve the role (usertype) of the currently logged-in user
            // 1. Auth::user() => gets the logged-in user
            // 2. ->usertype => gets their role (e.g., admin or user)
            $usertype = Auth::user()->usertype;

            if ($usertype === 'admin') {
                // 1. Fetch all necessary data for the Dashboard
                // Fetch all rooms from the database
                $rooms = Room::all();
                // Fetch all bookings from the database
                $booking = Booking::all();
                // Fetch all contacts from the database 
                $contact = Contact::all();

                // 2. Pass the data to the view simultaneously
                return view('admin.index', compact('rooms', 'booking', 'contact')); 
            } 
            
            if ($usertype === 'user') {
                $rooms = Room::all();
                $gallery = Gallery::all();
                return view('home.index', compact('rooms', 'gallery'));
            }
        }

        $rooms = Room::all();
        $gallery = Gallery::all(); 
        return view('home.index', compact('rooms', 'gallery'));
    }

    public function home()
    {
        $rooms = Room::all(); 
        $gallery = Gallery::all(); // Data fetched successfully here

        if (Auth::check()) {
            
            $usertype = Auth::user()->usertype; 

            if ($usertype === 'admin') {
                $booking = Booking::all();
                $contact = Contact::all();
                // For the Admin Dashboard
                return view('admin.index', compact('rooms', 'booking', 'contact'));
            }

            // For logged-in users: 'gallery' must be added into compact
            return view('home.index', compact('rooms', 'gallery'));
        }

        // For guests who are not logged in: 'gallery' must also be added into compact
        return view('home.index', compact('rooms', 'gallery'));
    }

    // Function to export PDF (kept standard)
    public function export_pdf()
    {
        $bookings = Booking::all(); 
        $pdf = Pdf::loadView('admin.pdf', compact('bookings')); 
        return $pdf->download('booking_list.pdf'); 
    }
    
    public function all_messages()
    {
        // Fetch all messages from the database
        $data = Contact::all(); 
        
        // Pass data to the view file that will be created in step 3
        return view('admin.all_messages', compact('data'));
    }
    
    public function send_mail(Request $request, $id)
    {
        // 1. Find the guest's contact data we want to reply to
        $contact = Contact::find($id);

        // 2. Prepare the details coming from the form (Greeting, Body, Action...)
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endline' => $request->endline,
        ];

        // 3. Save into the Notifications table (as history in the database)
        NotificationModel::create([
            'type' => 'Email Reply',
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endline' => $request->endline,
            'customer_email' => $contact->email,
        ]);

        // 4. Send the email to the actual guest (using the Notification Class noted earlier)
        Notification::send($contact, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Message sent and saved to the system successfully!');
    }

    public function delete_msg($id)
    {
        $data = Contact::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Message deleted from the system!');
    }
}