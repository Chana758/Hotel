<?php

namespace App\Http\Controllers;
use App\Models\Notification as NotificationModel; 
use App\Notifications\SendEmailNotification;   
use Illuminate\Support\Facades\Notification;   
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail; // Added for sending emails

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Contact::create($data); 

        return back()->with('success', 'Your message has been sent successfully!');
    }

    // --- Start adding the reply functionality here ---
    
    public function send_mail(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        // Using the null coalescing operator (??) 
        // If the body is not found, it falls back to the message instead
        $bodyContent = $request->body ?? $request->message;

        $details = [
            'greeting' => $request->greeting ?? "Hello {$contact->name},",
            'body' => $bodyContent, 
            'actiontext' => $request->actiontext ?? 'Visit KETO Hotel',
            'actionurl' => $request->actionurl ?? url('/'),
            'endline' => $request->endline ?? 'Thank you for choosing KETO Hotel!',
        ];

        // Save into the database
        NotificationModel::create([
            'type' => 'Email Reply',
            'greeting' => $details['greeting'],
            'body' => $details['body'],
            'actiontext' => $details['actiontext'],
            'actionurl' => $details['actionurl'],
            'endline' => $details['endline'],
            'customer_email' => $contact->email,
        ]);

        // Send the email
        Notification::send($contact, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email sent successfully!');
    }
}