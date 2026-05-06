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
    
    // Admin Only (Dewa Access)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        // Other admin only system settings could go here
    });

    // Admin & Petugas (Operational & Strategic)
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/petugas/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('petugas.dashboard');
        
        Route::get('/admin/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('admin.transactions.index');
        Route::post('/admin/transactions/{id}/status', [\App\Http\Controllers\TransactionController::class, 'updateStatus'])->name('admin.transactions.update');
        Route::get('/admin/export', [\App\Http\Controllers\TransactionController::class, 'exportReport'])->name('admin.export');
        
        // Inventory management (Petugas & Admin)
        Route::get('/admin/books', [\App\Http\Controllers\CatalogController::class, 'adminIndex'])->name('admin.books.index');
    });

    // Visitors & All Authenticated
    Route::get('/discover', [\App\Http\Controllers\DiscoverController::class, 'index'])->name('discover');
    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
    Route::post('/catalog/borrow/{bookId}', [\App\Http\Controllers\TransactionController::class, 'borrow'])->name('borrow.request');
    Route::get('/my-books', [\App\Http\Controllers\TransactionController::class, 'myBooks'])->name('user.my-books');

});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
