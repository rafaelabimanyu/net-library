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
        Route::post('/admin/users', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
        Route::put('/admin/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
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
        Route::post('/admin/books', [\App\Http\Controllers\CatalogController::class, 'store'])->name('admin.books.store');
        Route::put('/admin/books/{id}', [\App\Http\Controllers\CatalogController::class, 'update'])->name('admin.books.update');
        Route::delete('/admin/books/{id}', [\App\Http\Controllers\CatalogController::class, 'destroy'])->name('admin.books.destroy');
    });

    // Visitors & All Authenticated
    Route::get('/discover', [\App\Http\Controllers\DiscoverController::class, 'index'])->name('discover');
    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
    Route::post('/catalog/borrow/{bookId}', [\App\Http\Controllers\TransactionController::class, 'borrow'])->name('borrow.request');
    Route::get('/my-books', [\App\Http\Controllers\TransactionController::class, 'myBooks'])->name('user.my-books');

    // Profile Management
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');

    // Book Reviews
    Route::post('/books/{bookId}/review', [\App\Http\Controllers\BookReviewController::class, 'store'])->name('books.review');
    
    // Wishlist
    Route::match(['get', 'post'], '/wishlist/{book}', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Help Center / Guide
    Route::get('/guide', [\App\Http\Controllers\GuideController::class, 'index'])->name('guide.index');

});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
        session()->save();
    }
    return redirect()->back();
})->name('lang.switch');
