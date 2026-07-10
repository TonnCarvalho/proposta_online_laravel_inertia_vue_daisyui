<?php

use App\Http\Controllers\Web\Proposta\PropostaController;
use App\Http\Controllers\Web\Proposta\PropostaCreateController;
use App\Http\Controllers\Web\Proposta\PropostaPostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/proposta', [PropostaController::class, 'index'])->name('proposta.index');

    Route::prefix('/proposta')->group(function () {
        Route::get('/criar', [PropostaCreateController::class, 'create'])
            ->name('proposta.create');
        
        Route::post('/criar', [PropostaPostController::class, 'store'])
            ->name('proposta.post');
    });
});
