<?php

use App\Http\Controllers\Web\Associado\PesquisaCpfCadastro;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('proposta')
    ->group(function () {
        Route::get('/pesquisa', [PesquisaCpfCadastro::class, 'index'])
            ->name('pesquisaCpfCadastro.index');

    });
Route::middleware('auth')
    ->group(function () {

        Route::get('associado/pesquisar', [PesquisaCpfCadastro::class, 'pesquisarAssociado']);
    });
