<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrackLinkClick;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest link generation (no auth required)
Route::post('/guest-link', [LinkController::class, 'guestStore'])->name('guest.link.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    Route::resource('links', LinkController::class)->except(['create', 'show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::patch('/settings/redirect', [AdminController::class, 'updateRedirectSetting'])->name('settings.redirect');
    Route::patch('/links/batch-redirect', [AdminController::class, 'batchUpdateRedirect'])->name('links.batch-redirect');
});

// Short Link resolution (Must be at the bottom to avoid overriding other routes)
Route::post('/{link}/unlock', [RedirectController::class, 'unlock'])->name('links.unlock');
Route::get('/{code}', [RedirectController::class, 'redirect'])->middleware(TrackLinkClick::class)->name('redirect');
