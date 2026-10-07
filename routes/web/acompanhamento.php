<?php

use App\Http\Controllers\Web\Acompanhamento\AcompanhamentoIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/acompanhamento', [AcompanhamentoIndexController::class, 'index'])
        ->name('acompanhamento.index');
});
