<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk area yang memerlukan login (member)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Route untuk artikel dan video akan ditambahkan nanti
});

// Route untuk area admin (memerlukan login dan role admin - nanti bisa ditambahkan middleware custom)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route untuk CRUD membership, artikel, video akan ditambahkan nanti
});

// Route untuk login via Google
Route::get('/auth/google', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleGoogleCallback']);

// Route untuk login via Facebook
Route::get('/auth/facebook', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleFacebookCallback']);

require __DIR__.'/auth.php';
