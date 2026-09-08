<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Room;    // Import Room Model
use App\Models\Booking; // Import Booking Model
use App\Models\Contact; // Import Contact Model to fetch counts for Statistics Cards

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        // Fetch data for the Statistics Cards in the Sidebar/Body
        $rooms = Room::all();
        $booking = Booking::all();
        $contact = Contact::all();
        return view('admin.setting', compact('settings', 'rooms', 'booking', 'contact'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            // If it is a file (Logo or Admin Image)
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                // Generate a new unique file name to prevent duplicates
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                // Move to public/uploads/settings/
                $file->move(public_path('uploads/settings'), $filename);
                $value = 'uploads/settings/' . $filename;
            }

            // Only save if the value is not null (prevents losing the old image when updating text)
            if ($value !== null) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return back()->with('success', 'Settings have been saved successfully!');
    }
}