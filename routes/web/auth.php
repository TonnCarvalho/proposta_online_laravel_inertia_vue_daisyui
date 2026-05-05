<?php

use App\Http\Controllers\Web\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'index'])
        ->name('auth.index');
    Route::post('/login', [AuthenticationController::class, 'store'])
        ->name('auth.store');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'destroy'])
        ->name('auth.destroy');
});
