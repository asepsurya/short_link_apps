<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrackLinkClick;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Language switch
Route::get('/lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');

// Google Authentication Routes
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// Public Documentation
Route::get('/docs', function () {
    return view('docs');
})->name('docs');

// Guest link generation (no auth required)
Route::post('/guest-link', [LinkController::class, 'guestStore'])->name('guest.link.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    Route::resource('links', LinkController::class)->except(['create', 'show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/token', [ProfileController::class, 'generateToken'])->name('profile.token.generate');
    Route::delete('/profile/token', [ProfileController::class, 'revokeTokens'])->name('profile.token.revoke');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::patch('/settings/redirect', [AdminController::class, 'updateRedirectSetting'])->name('settings.redirect');
    Route::patch('/settings/api', [AdminController::class, 'updateApiSettings'])->name('settings.api');
    Route::patch('/links/batch-redirect', [AdminController::class, 'batchUpdateRedirect'])->name('links.batch-redirect');
    Route::get('/settings', [AdminController::class, 'appSettings'])->name('settings');
    Route::patch('/settings/app', [AdminController::class, 'updateAppSettings'])->name('settings.update-app');
    Route::patch('/settings/api', [AdminController::class, 'updateApiSettings'])->name('settings.update-api');
});

// Short Link resolution (Must be at the bottom to avoid overriding other routes)
Route::post('/{link}/unlock', [RedirectController::class, 'unlock'])->name('links.unlock');
Route::get('/{code}', [RedirectController::class, 'redirect'])->middleware(TrackLinkClick::class)->name('redirect');
