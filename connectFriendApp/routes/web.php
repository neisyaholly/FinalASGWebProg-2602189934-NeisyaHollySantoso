<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/payment', function () {
    $user = Auth::user();
    $price = $user->register_price;
    return view('payment', compact('price'));
})->name('payment');

Route::post('/updatePaid', [PaymentController::class, 'update_paid']);

Route::get('/overpayment', [PaymentController::class, 'handleOverpayment'])->name('handle.overpayment');
Route::post('/overpayment', [PaymentController::class, 'processOverpayment'])->name('process.overpayment');

Route::middleware(['auth', 'paid'])->group(function () {
    // Route::get('/home', function () {
    //     return view('home');
    // })->name('home');

    Route::get('/home', [UserController::class, 'index'])->name('home');

    Route::resource('user', UserController::class);
    Route::resource('friend-request', FriendRequestController::class);
    Route::resource('friend', FriendController::class);
    Route::resource('message', MessageController::class);
});
