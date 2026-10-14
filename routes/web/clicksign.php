<?php

use App\Http\Controllers\Web\ClickSign\ClickSignEnviadasController;
use App\Http\Controllers\Web\ClickSign\ClickSignEnviarController;
use App\Http\Controllers\Web\ClickSign\ClickSignIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('click-sign')
    ->group(function () {

        Route::get('/', [ClickSignIndexController::class, 'index'])
            ->name('clicksign.index');

        Route::get('/enviar', [ClickSignEnviarController::class, 'enviarView'])
            ->name('clicksign.enviar');

        Route::post('/enviar', [ClickSignEnviarController::class, 'processarEnvelope'])
            ->name('clicksign.enviar.proposta');

        Route::get('/enviadas', [ClickSignEnviadasController::class, 'enviadas'])
            ->name('clicksign.enviadas');
    });
