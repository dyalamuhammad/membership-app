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
    Route::get('/member', [HomeController::class, 'index'])->name('member.home');
    // Route untuk artikel dan video akan ditambahkan nanti
});

// Route untuk login via Google
Route::get('/auth/google', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleGoogleCallback']);

// Route untuk login via Facebook
Route::get('/auth/facebook', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleFacebookCallback']);

// Route untuk area admin (memerlukan login dan role admin - nanti bisa ditambahkan middleware custom)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route untuk CRUD Membership (manual)
    Route::get('/memberships', [\App\Http\Controllers\Admin\MembershipController::class, 'index'])->name('admin.memberships.index');
    Route::get('/memberships/create', [\App\Http\Controllers\Admin\MembershipController::class, 'create'])->name('admin.memberships.create');
    Route::post('/memberships', [\App\Http\Controllers\Admin\MembershipController::class, 'store'])->name('admin.memberships.store');
    Route::get('/memberships/{membership}/edit', [\App\Http\Controllers\Admin\MembershipController::class, 'edit'])->name('admin.memberships.edit');
    Route::put('/memberships/{membership}', [\App\Http\Controllers\Admin\MembershipController::class, 'update'])->name('admin.memberships.update');
    Route::delete('/memberships/{membership}', [\App\Http\Controllers\Admin\MembershipController::class, 'destroy'])->name('admin.memberships.destroy');

    // Route untuk CRUD Artikel (manual)
    Route::get('/articles', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/create', [\App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{article}/edit', [\App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/articles/{article}', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{article}', [\App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('admin.articles.destroy');

    // Route untuk CRUD Video (manual)
    Route::get('/videos', [\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('admin.videos.index');
    Route::get('/videos/create', [\App\Http\Controllers\Admin\VideoController::class, 'create'])->name('admin.videos.create');
    Route::post('/videos', [\App\Http\Controllers\Admin\VideoController::class, 'store'])->name('admin.videos.store');
    Route::get('/videos/{video}/edit', [\App\Http\Controllers\Admin\VideoController::class, 'edit'])->name('admin.videos.edit');
    Route::put('/videos/{video}', [\App\Http\Controllers\Admin\VideoController::class, 'update'])->name('admin.videos.update');
    Route::delete('/videos/{video}', [\App\Http\Controllers\Admin\VideoController::class, 'destroy'])->name('admin.videos.destroy');

    // Route untuk CRUD User (hanya index, edit, update)
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
});

require __DIR__.'/auth.php';
