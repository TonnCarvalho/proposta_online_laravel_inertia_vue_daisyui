<?php

use App\Http\Controllers\Web\Proposta\PropostaController;
use App\Http\Controllers\Web\Proposta\PropostaCreateController;
use App\Http\Controllers\Web\Proposta\PropostaStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/proposta', [PropostaController::class, 'index'])->name('proposta.index');

    Route::prefix('/proposta')->group(function () {
        Route::get('/criar', [PropostaCreateController::class, 'create'])
            ->name('proposta.create');

        Route::post('/criar', [PropostaStoreController::class, 'store'])
            ->name('proposta.post');

        Route::get('/sucesso', [PropostaCreateController::class, 'sucess']);
    });
});
