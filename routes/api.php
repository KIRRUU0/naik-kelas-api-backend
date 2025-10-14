<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\ModulBisnisController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LayananUmumController;
use App\Http\Controllers\LowonganKarirController;
use App\Http\Controllers\PaketKemitraanController;
use App\Http\Controllers\MitraBrokerController;

/*
|--------------------------------------------------------------------------
| API Routes: Diatur berdasarkan Level Keamanan
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. RUTE PUBLIK (Dapat diakses tanpa login)
// =========================================================================

// Rute Spesifik (Statistik) harus ditempatkan di atas rute resource
Route::get('webinar/statistik', [WebinarController::class, 'statistik']);

// RUTE PENDAFTARAN: POST Pengguna harus PUBLIK agar user baru bisa mendaftar
Route::post('pengguna', [PenggunaController::class, 'store']); 

// Rute READ Publik (GET index & show)
Route::apiResource('webinar', WebinarController::class)->only(['index', 'show']);
Route::apiResource('modul-bisnis', ModulBisnisController::class)->only(['index', 'show']);
Route::apiResource('layanan-umum', LayananUmumController::class)->only(['index', 'show']);
Route::apiResource('lowongan-karir', LowonganKarirController::class)->only(['index', 'show']);
Route::apiResource('pengguna', PenggunaController::class)->only(['index', 'show']);


// =========================================================================
// 2. RUTE TERLINDUNGI (Membutuhkan Login Admin / auth:sanctum)
// =========================================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // Rute default user Sanctum
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Rute CUD (Create, Update, Delete)
    Route::apiResource('webinar', WebinarController::class)->except(['index', 'show']); 
    Route::apiResource('modul-bisnis', ModulBisnisController::class)->except(['index', 'show']);
    Route::apiResource('layanan-umum', LayananUmumController::class)->except(['index', 'show']);
    Route::apiResource('lowongan-karir', LowonganKarirController::class)->except(['index', 'show']);
    
    // UPDATE dan DELETE pengguna
    Route::apiResource('pengguna', PenggunaController::class)->except(['index', 'show', 'store']);
    
    // Rute CRUD Penuh untuk resource tersisa
    Route::apiResource('paket-kemitraan', PaketKemitraanController::class);
    Route::apiResource('mitra-broker', MitraBrokerController::class);
});