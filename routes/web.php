<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\InputDataController;
use App\Http\Controllers\HasilKlasifikasiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MeasurementHistoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');
Route::get('/input-data', [InputDataController::class, 'index'])->name('input-data');
Route::post('/hasil-klasifikasi', [HasilKlasifikasiController::class, 'store'])->name('hasil-klasifikasi.store');

// Catalog routes (require authentication)
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ReviewController;
Route::middleware(['auth'])->group(function () {
    Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
    Route::get('/catalogs/{id}', [CatalogController::class, 'show'])->name('catalogs.show');
    Route::get('/nailist/{nailistId}/profile', [CatalogController::class, 'nailistProfile'])->name('nailist.public.profile');

    // Review routes
    Route::post('/catalogs/{catalogId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/catalogs/{catalogId}/reviews/{reviewId}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/catalogs/{catalogId}/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Product routes
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');

// Measurement History routes
Route::get('/riwayat', [MeasurementHistoryController::class, 'index'])->name('measurements.index');
Route::get('/riwayat/{id}', [MeasurementHistoryController::class, 'show'])->name('measurements.show');
Route::get('/riwayat/{id}/print', [MeasurementHistoryController::class, 'print'])->name('measurements.print');
Route::delete('/riwayat/{id}', [MeasurementHistoryController::class, 'destroy'])->name('measurements.destroy');

// Admin routes
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SizeStandardController;
use App\Http\Controllers\Admin\AdminMeasurementController;
use App\Http\Controllers\Admin\NailistController as AdminNailistController;
use App\Http\Controllers\Admin\CatalogModerationController;
use App\Http\Controllers\Auth\RoleSelectionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Customer Authentication
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin/Nailist Portal Login
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

// Role selection (for users with multiple roles)
Route::middleware(['auth'])->group(function () {
    Route::get('/select-role', [RoleSelectionController::class, 'show'])->name('role.selection');
    Route::post('/select-role', [RoleSelectionController::class, 'select'])->name('role.select');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Size Standards Management
    Route::resource('size-standards', SizeStandardController::class);

    // Measurements Management
    Route::get('/measurements', [AdminMeasurementController::class, 'index'])->name('measurements.index');
    Route::get('/measurements/{measurement}', [AdminMeasurementController::class, 'show'])->name('measurements.show');
    Route::delete('/measurements/{measurement}', [AdminMeasurementController::class, 'destroy'])->name('measurements.destroy');

    // Nailist Management
    Route::get('/nailists', [AdminNailistController::class, 'index'])->name('nailists.index');
    Route::get('/nailists/{id}', [AdminNailistController::class, 'show'])->name('nailists.show');
    Route::post('/nailists/{id}/approve', [AdminNailistController::class, 'approve'])->name('nailists.approve');
    Route::post('/nailists/{id}/reject', [AdminNailistController::class, 'reject'])->name('nailists.reject');
    Route::post('/nailists/{id}/reset', [AdminNailistController::class, 'resetApproval'])->name('nailists.reset');

    // Catalog Moderation
    Route::get('/catalogs', [CatalogModerationController::class, 'index'])->name('catalogs.index');
    Route::get('/catalogs/{id}', [CatalogModerationController::class, 'show'])->name('catalogs.show');
    Route::post('/catalogs/{id}/deactivate', [CatalogModerationController::class, 'deactivate'])->name('catalogs.deactivate');
    Route::post('/catalogs/{id}/restore', [CatalogModerationController::class, 'restore'])->name('catalogs.restore');
    Route::post('/catalogs/{id}/images/remove', [CatalogModerationController::class, 'removeImage'])->name('catalogs.images.remove');
    Route::delete('/catalogs/{id}', [CatalogModerationController::class, 'destroy'])->name('catalogs.destroy');
});

// Nailist routes
use App\Http\Controllers\Nailist\NailistController;
use App\Http\Controllers\Nailist\CatalogController as NailistCatalogController;

Route::middleware(['auth'])->prefix('nailist')->name('nailist.')->group(function () {
    Route::get('/dashboard', [NailistController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [NailistController::class, 'profile'])->name('profile');
    Route::put('/profile', [NailistController::class, 'updateProfile'])->name('profile.update');

    // Catalog Management
    Route::resource('catalogs', NailistCatalogController::class);

    // Logout (shared with admin)
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});

