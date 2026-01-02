<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('dashboard.admin');
        } else {
            return redirect()->route('dashboard.user');
        }
    })->name('home');

    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard', [HomeController::class, 'user'])->name('dashboard.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login/proses', 'login')->name('loginProcess');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register/proses', 'register')->name('registerProcess');
});
