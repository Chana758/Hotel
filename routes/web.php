<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use App\Models\Gallery;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AdminController::class, 'home'])->name('home');

// Static pages
Route::view('/about', 'home.about_page');
Route::view('/contact', 'home.contact_page');

Route::get('/our_rooms', fn () => view('home.ourroom_page', ['rooms' => Room::all()]));
Route::get('/hotel_gallery', fn () => view('home.gallery_page', ['gallery' => Gallery::all()]));
Route::get('/room_detail/{id}', [HomeController::class, 'room_detail'])->name('room_detail');

// Contact form
Route::post('/store_contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Authenticated routes (any logged-in user)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Jetstream redirects here after login; AdminController@index decides where to send the user
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/home', [AdminController::class, 'index'])->name('home_redirect');

    // Customers book a room from the public room page
    Route::post('/add_booking/{id}', [BookingController::class, 'store'])->name('booking.store');
});

/*
|--------------------------------------------------------------------------
| Admin-only routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Rooms
    Route::get('/view_room', [RoomController::class, 'index'])->name('admin.view_room');
    Route::get('/create_room', [RoomController::class, 'create'])->name('admin.create_room');
    Route::post('/store_room', [RoomController::class, 'store'])->name('admin.store_room');
    Route::get('/edit_room/{id}', [RoomController::class, 'edit'])->name('admin.edit_room');
    Route::put('/update_room/{id}', [RoomController::class, 'update'])->name('admin.update_room');
    Route::delete('/delete_room/{id}', [RoomController::class, 'destroy'])->name('admin.delete_room');

    // Bookings
    Route::get('/view_bookings', [BookingController::class, 'index'])->name('admin.view_bookings');
    Route::get('/add_booking', [BookingController::class, 'create'])->name('add_booking');
    Route::post('/save_booking', [BookingController::class, 'save_booking'])->name('save_booking');
    Route::get('/edit_booking/{id}', [BookingController::class, 'edit_booking'])->name('edit_booking');
    Route::post('/update_booking/{id}', [BookingController::class, 'update_booking'])->name('update_booking');
    Route::get('/delete_booking/{id}', [BookingController::class, 'destroy'])->name('admin.delete_booking');
    Route::get('/approve_booking/{id}', [BookingController::class, 'approve_booking'])->name('approve_booking');
    Route::get('/reject_booking/{id}', [BookingController::class, 'reject_booking'])->name('reject_booking');
    Route::get('/export_pdf', [AdminController::class, 'export_pdf'])->name('export_pdf');

    // Gallery
    Route::get('/view_gallery', [GalleryController::class, 'view_gallery'])->name('view_gallery');
    Route::post('/upload_gallery', [GalleryController::class, 'upload_gallery'])->name('upload_gallery');
    Route::get('/delete_gallery/{id}', [GalleryController::class, 'delete_gallery'])->name('delete_gallery');

    // Settings
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/up_setting', [SettingController::class, 'update'])->name('admin.setting.update');

    // Messages
    Route::get('/all_messages', [AdminController::class, 'all_messages'])->name('admin.messages');
    Route::post('/send_mail/{id}', [ContactController::class, 'send_mail'])->name('send_mail');
    Route::get('/delete_msg/{id}', [AdminController::class, 'delete_msg'])->name('admin.delete_msg');
});