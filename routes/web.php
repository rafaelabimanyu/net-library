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
    
    // Admin & Petugas Only
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/admin/transactions', [\App\Http\Controllers\TransactionController.php, 'index'])->name('admin.transactions.index');
        Route::post('/admin/transactions/{id}/status', [\App\Http\Controllers\TransactionController::php, 'updateStatus'])->name('admin.transactions.update');
    });

    // Pengunjung & All Authenticated
    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
    Route::post('/catalog/borrow/{bookId}', [\App\Http\Controllers\TransactionController::class, 'borrow'])->name('borrow.request');

});
