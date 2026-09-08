<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Initial page (Public) - named 'home' to avoid menu errors
Route::get('/', [AdminController::class, 'home'])->name('home');

// 2. Dashboard page - redirected by Jetstream after login (named 'dashboard')
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

// 3. If any code redirects to /home, route it to index (check usertype) and name it
Route::get('/home', [AdminController::class, 'index'])->name('home_redirect');

// Route for viewing room details
Route::get('/room_detail/{id}', [HomeController::class, 'room_detail'])->name('room_detail');

// Home Page
Route::get('/about', function () {
    return view('home.about_page');
});
Route::get('/contact', function () {
    return view('home.contact_page');
});
Route::get('/our_rooms', function () {
    $rooms = App\Models\Room::all(); 
    return view('home.ourroom_page', compact('rooms')); 
});
Route::get('/hotel_gallery', function () {
    $gallery = App\Models\Gallery::all(); 
    return view('home.gallery_page', compact('gallery'));
});

// Contact form
Route::post('/store_contact', [ContactController::class, 'store'])->name('contact.store');

// 4. Exclusive Admin routes (safest placed here)
Route::middleware(['auth', 'admin'])->group(function () {

    // Room routes
    Route::post('/store_room', [RoomController::class, 'store'])->name('admin.store_room');
    Route::get('/edit_room/{id}', [RoomController::class, 'edit'])->name('admin.edit_room');
    Route::put('/update_room/{id}', [RoomController::class, 'update'])->name('admin.update_room');
    Route::delete('/delete_room/{id}', [RoomController::class, 'destroy'])->name('admin.delete_room');
    Route::get('/view_room', [RoomController::class, 'index'])->name('admin.view_room');
    Route::get('/create_room', [RoomController::class, 'create'])->name('admin.create_room');

    // Admin booking routes
    Route::post('/add_booking/{id}', [BookingController::class, 'store'])->name('add_booking');
    Route::get('/view_bookings', [BookingController::class, 'index'])->name('admin.view_bookings');
    Route::get('/edit_booking/{id}', [App\Http\Controllers\BookingController::class, 'edit_booking'])->name('edit_booking');
    Route::post('/update_booking/{id}', [App\Http\Controllers\BookingController::class, 'update_booking'])->name('update_booking');
    Route::get('/delete_booking/{id}', [BookingController::class, 'destroy'])->name('admin.delete_booking');
    Route::get('/add_booking', [App\Http\Controllers\BookingController::class, 'create'])->name('add_booking');
    Route::post('/save_booking', [App\Http\Controllers\BookingController::class, 'save_booking'])->name('save_booking');
    Route::get('/approve_booking/{id}', [BookingController::class, 'approve_booking'])->name('approve_booking');
    Route::get('/reject_booking/{id}', [BookingController::class, 'reject_booking'])->name('reject_booking');
    
    // Export PDF
    Route::get('/export_pdf', [AdminController::class, 'export_pdf'])->name('export_pdf');
   
    // Admin gallery management
    Route::get('/view_gallery', [GalleryController::class, 'view_gallery'])->name('view_gallery');
    Route::post('/upload_gallery', [GalleryController::class, 'upload_gallery'])->name('upload_gallery');
    Route::get('/delete_gallery/{id}', [GalleryController::class, 'delete_gallery'])->name('delete_gallery');

    // Settings
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.settings');
    // Changed from 'admin.settings.update' to 'admin.setting.update' to match the form
    Route::post('/up_setting', [SettingController::class, 'update'])->name('admin.setting.update');

    // Email reply routes
    Route::post('/send_mail/{id}', [ContactController::class, 'send_mail'])->name('send_mail'); 
    Route::get('/all_messages', [AdminController::class, 'all_messages']);
    Route::get('/delete_msg/{id}', [AdminController::class, 'delete_msg']);
});