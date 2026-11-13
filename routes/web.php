<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PcAssetController;
use Illuminate\Support\Facades\Route;

// Halaman awal langsung diarahkan ke daftar aset
// (jika belum login, middleware 'auth' akan meneruskan ke /login)
Route::redirect('/', '/pc-assets');

/**
 * Route untuk tamu (belum login).
 * Middleware 'guest' : jika sudah login, otomatis dilempar ke halaman daftar aset.
 * Route login WAJIB diberi nama 'login' karena middleware 'auth' mencari route bernama itu.
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

/**
 * Route untuk user yang sudah login.
 * Middleware 'auth' : jika belum login, otomatis dilempar ke /login.
 */
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('pc-assets', PcAssetController::class);
});