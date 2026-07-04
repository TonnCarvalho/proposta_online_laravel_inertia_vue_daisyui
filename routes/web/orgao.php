<?php

use App\Http\Controllers\Web\Orgao\OrgaoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('orgao')
    ->group(function () {
        Route::get('/por-praca/{cod_local}', [OrgaoController::class, 'porPraca'])
            ->name('orgao.porPraca')
            ->whereNumber('cod_local');

    });
