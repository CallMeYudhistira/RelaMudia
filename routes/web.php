<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', HomeController::class)->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/data')->group(function(){
        Route::resource('users', UserController::class);
        Route::redirect('/', route('users.index'))->name('data');
    });
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login/proses', 'login')->name('loginProcess');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register/proses', 'register')->name('registerProcess');
});


    Route::get('/logout1', [AuthController::class, 'logout1'])->name('transaction');
    Route::get('/logout2', [AuthController::class, 'logout2'])->name('profile');
    Route::get('/logout3', [AuthController::class, 'logout3'])->name('report');
    Route::get('/logout4', [AuthController::class, 'logout4'])->name('items');
    Route::get('/logout5', [AuthController::class, 'logout5'])->name('payment');
