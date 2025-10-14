<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginFrom'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

// Rute yang dilindungi oleh middleware autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});