<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Admin Only
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return "Admin Dashboard";
        })->name('admin.dashboard');
    });

    // Petugas Only
    Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
        Route::get('/dashboard', function () {
            return "Petugas Dashboard";
        })->name('petugas.dashboard');
    });

    // Pengunjung & All Authenticated
    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

});
