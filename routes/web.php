<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Data\CategoryController;
use App\Http\Controllers\Data\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', HomeController::class)->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/data')->group(function(){
        Route::resource('users', UserController::class);
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::redirect('/', route('users.index'))->name('data');
    });

    Route::prefix('/transaction')->group(function(){
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    });

    Route::prefix('/profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    });

    Route::prefix('/report')->group(function(){
        Route::get('/', [ReportController::class, 'index'])->name('report.index');
    });

    Route::prefix('/items')->group(function(){
        Route::get('/', [\App\Http\Controllers\ItemController::class, 'index'])->name('items.list');
    });

    Route::prefix('/payment')->group(function(){
        Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
    });
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login/proses', 'login')->name('loginProcess');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register/proses', 'register')->name('registerProcess');
});
