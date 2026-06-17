<?php

use App\Http\Controllers\Web\Proposta\PropostaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/proposta', [PropostaController::class, 'index'])->name('proposta.index');

    
});
