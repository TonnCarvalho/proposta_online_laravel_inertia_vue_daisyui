<?php

use App\Http\Controllers\Api\Associado\PesquisaAssociado;
use Illuminate\Support\Facades\Route;

Route::get('associado/pesquisar', [PesquisaAssociado::class, 'pesquisar']);
