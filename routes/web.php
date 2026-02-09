<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserListingPublicController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminUserListingController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserListingController;
use App\Http\Controllers\User\UserProfileController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/listing/{id}', [HomeController::class, 'show'])->name('listing.show');

// Public User Listings Routes
Route::get('/shpalljet-perdoruesve', [UserListingPublicController::class, 'index'])->name('public.user-listings');
Route::get('/shpalljet-perdoruesve/{id}', [UserListingPublicController::class, 'show'])->name('public.user-listing.show');

// Review Routes
Route::post('/listing/{id}/review', [ReviewController::class, 'store'])->name('review.store');

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Admin Categories
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

// Admin Listings
Route::get('/admin/listings', [ListingController::class, 'index'])->name('admin.listings.index');
Route::get('/admin/listings/create', [ListingController::class, 'create'])->name('admin.listings.create');
Route::post('/admin/listings', [ListingController::class, 'store'])->name('admin.listings.store');
Route::get('/admin/listings/{id}/edit', [ListingController::class, 'edit'])->name('admin.listings.edit');
Route::put('/admin/listings/{id}', [ListingController::class, 'update'])->name('admin.listings.update');
Route::delete('/admin/listings/{id}', [ListingController::class, 'destroy'])->name('admin.listings.destroy');

// Admin Reviews
Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
Route::post('/admin/reviews/{id}/approve', [AdminReviewController::class, 'approve'])->name('admin.reviews.approve');
Route::post('/admin/reviews/{id}/reject', [AdminReviewController::class, 'reject'])->name('admin.reviews.reject');
Route::delete('/admin/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

// Admin User Listings
Route::get('/admin/user-listings', [AdminUserListingController::class, 'index'])->name('admin.user-listings.index');
Route::get('/admin/user-listings/{id}', [AdminUserListingController::class, 'show'])->name('admin.user-listings.show');
Route::get('/admin/user-listings/{id}/edit', [AdminUserListingController::class, 'edit'])->name('admin.user-listings.edit');
Route::put('/admin/user-listings/{id}', [AdminUserListingController::class, 'update'])->name('admin.user-listings.update');
Route::post('/admin/user-listings/{id}/approve', [AdminUserListingController::class, 'approve'])->name('admin.user-listings.approve');
Route::post('/admin/user-listings/{id}/reject', [AdminUserListingController::class, 'reject'])->name('admin.user-listings.reject');
Route::delete('/admin/user-listings/{id}', [AdminUserListingController::class, 'destroy'])->name('admin.user-listings.destroy');

// User Authentication
Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login']);
Route::get('/user/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register']);
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// User Dashboard
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

// User Profile
Route::put('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

// User Listings (User Panel)
Route::get('/user/shpalljet', [UserListingController::class, 'index'])->name('user.listings.index');
Route::get('/user/shpalljet/create', [UserListingController::class, 'create'])->name('user.listings.create');
Route::post('/user/shpalljet', [UserListingController::class, 'store'])->name('user.listings.store');
Route::get('/user/shpalljet/{id}', [UserListingController::class, 'show'])->name('user.listings.show');
Route::get('/user/shpalljet/{id}/edit', [UserListingController::class, 'edit'])->name('user.listings.edit');
Route::put('/user/shpalljet/{id}', [UserListingController::class, 'update'])->name('user.listings.update');
Route::delete('/user/shpalljet/{id}', [UserListingController::class, 'destroy'])->name('user.listings.destroy');