<?php

use App\Http\Controllers\Web\ClickSign\ClickSignEnviadasController;
use App\Http\Controllers\Web\ClickSign\ClickSignEnviarController;
use App\Http\Controllers\Web\ClickSign\ClickSignIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/click-sign', [ClickSignIndexController::class, 'index'])
        ->name('clicksign.index');

    Route::get('/click-sign/enviar', [ClickSignEnviarController::class, 'enviar'])
        ->name('clicksign.enviar');

    Route::get('/click-sign/enviadas', [ClickSignEnviadasController::class, 'enviadas'])
        ->name('clicksign.enviadas');
});
