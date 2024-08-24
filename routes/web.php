<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

// Rute untuk tampilan home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute lainnya
Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthenticationController::class, 'register'])->name('saveRegister');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/registration-payment', function () {
    $user = Auth::user();
    $price = $user->register_price;
    return view('payment', compact('price'));
})->name('paymentCheck');

Route::post('/paid', [AuthenticationController::class, 'paid'])->name('paid');

Route::get('/overpaid', [AuthenticationController::class, 'overpaid'])->name('overpaid');
Route::post('/overpaid', [AuthenticationController::class, 'overpaidTransfer'])->name('overpaidTransfer');


Route::get('/locale/{loc}', function ($loc) {
    Session::put('locale', $loc);
    return redirect()->back();
})->name('locale');


Route::middleware(['auth', 'paid'])->group(function () {
    
    Route::get('/home', [UserController::class, 'index'])->name('user.home'); // Ganti dengan route yang sesuai
    Route::resource('user', UserController::class);
    Route::resource('friend-request', FriendRequestController::class);
    Route::resource('friend', FriendController::class);
    Route::resource('message', MessageController::class);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/video-call', [MessageController::class, 'startVideoCall'])->name('video.call');

});
