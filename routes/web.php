<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserListingPublicController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/listing/{id}', [HomeController::class, 'show'])->name('listing.show');

Route::post('/listing/{id}/review', [ReviewController::class, 'store'])->name('review.store');

Route::get('/user-listings', [UserListingPublicController::class, 'index'])->name('public.user-listings');

Route::get('/user-listing/{id}', [UserListingPublicController::class, 'show'])->name('public.user-listing.show');

Route::get('/user/register', function () {
    return view('user.register');
})->name('user.register');

// Admin Routes
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');