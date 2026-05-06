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
        
        Route::get('/admin/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('admin.transactions.index');
        Route::post('/admin/transactions/{id}/status', [\App\Http\Controllers\TransactionController::class, 'updateStatus'])->name('admin.transactions.update');
        Route::get('/admin/export', [\App\Http\Controllers\TransactionController::class, 'exportReport'])->name('admin.export');
    });

    // Pengunjung & All Authenticated
    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
    Route::post('/catalog/borrow/{bookId}', [\App\Http\Controllers\TransactionController::class, 'borrow'])->name('borrow.request');
    Route::get('/my-books', [\App\Http\Controllers\TransactionController::class, 'myBooks'])->name('user.my-books');

});
