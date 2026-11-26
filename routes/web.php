<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PcAssetController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pc-assets');

// 1. Guest Middleware & Throttle (Rate Limiting pada Form Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:20,1')
        ->name('login.process');
});

// 2. Proteksi Wajib Login (auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 3. Akses untuk kedua role: Admin dan User biasa
    Route::middleware('role:admin,user')->group(function () {
        Route::get('/pc-assets', [PcAssetController::class, 'index'])->name('pc-assets.index');
        Route::get('/pc-assets/{pc_asset}', [PcAssetController::class, 'show'])->name('pc-assets.show');
    });

    // 4. Akses khusus Admin untuk aksi CRUD
    Route::middleware('role:admin')->group(function () {
        Route::get('/pc-assets/create', [PcAssetController::class, 'create'])->name('pc-assets.create');
        Route::post('/pc-assets', [PcAssetController::class, 'store'])->name('pc-assets.store');
        Route::get('/pc-assets/{pc_asset}/edit', [PcAssetController::class, 'edit'])->name('pc-assets.edit');
        Route::match(['put', 'patch'], '/pc-assets/{pc_asset}', [PcAssetController::class, 'update'])->name('pc-assets.update');
        Route::delete('/pc-assets/{pc_asset}', [PcAssetController::class, 'destroy'])->name('pc-assets.destroy');
    });
});
