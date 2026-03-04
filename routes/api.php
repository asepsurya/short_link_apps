<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLinkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Authenticated API Routes — require a Sanctum Bearer token
 */
Route::middleware([
    'auth:sanctum', 
    'throttle:' . Cache::get('platform.api_rate_limit', 60) . ',1',
    \App\Http\Middleware\ApiRequestTracker::class
])->prefix('v1')->name('api.v1.')->group(function () {
    // Create a short link
    Route::post('/links', [ApiLinkController::class , 'store'])->name('links.store');
    // List all user's links (with pagination)
    Route::get('/links', [ApiLinkController::class , 'index'])->name('links.index');
    // Get a single link's details
    Route::get('/links/{link}', [ApiLinkController::class , 'show'])->name('links.show');
    // Update a link
    Route::put('/links/{link}', [ApiLinkController::class , 'update'])->name('links.update');
    // Delete a link
    Route::delete('/links/{link}', [ApiLinkController::class , 'destroy'])->name('links.destroy');
    // Get click stats for a specific link
    Route::get('/links/{link}/stats', [ApiLinkController::class , 'stats'])->name('links.stats');
});
