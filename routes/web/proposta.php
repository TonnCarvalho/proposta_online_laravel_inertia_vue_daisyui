<?php

use App\Http\Controllers\Web\Proposta\PesquisaCpfCadastroController;
use App\Http\Controllers\Web\Proposta\PropostaController;
use App\Http\Controllers\Web\Proposta\PropostaCreateController;
use App\Http\Controllers\Web\Proposta\PropostaEditController;
use App\Http\Controllers\Web\Proposta\PropostaStoreController;
use App\Http\Controllers\Web\Proposta\PropostaSucessoController;
use App\Http\Controllers\Web\Proposta\PropostaUpdateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('/proposta')->group(function () {
        Route::get('/', [PropostaController::class, 'index'])
            ->name('proposta.index');

        Route::get('/criar/{tipoCadastro?}/{associado?}', [PropostaCreateController::class, 'create'])
            ->where('tipoCadastro', '[a-z_]+')
            ->whereNumber('associado')
            ->name('proposta.create');

        Route::post('/criar', [PropostaStoreController::class, 'store'])
            ->name('proposta.store');

        Route::get('/{id_proposta}/edit', [PropostaEditController::class, 'edit'])
            ->whereNumber('id_proposta')
            ->name('proposta.edit');

        Route::put('/{id_proposta}', [PropostaUpdateController::class, 'update'])
            ->whereNumber('id_proposta')
            ->name('proposta.update');

        Route::get('/pesquisa', [PesquisaCpfCadastroController::class, 'index'])
            ->name('pesquisaCpfCadastro.index');

        Route::get('/pesquisar', [PesquisaCpfCadastroController::class, 'pesquisarAssociado']);

        Route::get('/sucesso', [PropostaSucessoController::class, 'index'])
            ->name('proposta.sucesso');
    });
});
