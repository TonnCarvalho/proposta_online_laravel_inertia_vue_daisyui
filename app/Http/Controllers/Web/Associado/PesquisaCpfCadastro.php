<?php

namespace App\Http\Controllers\Web\Associado;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PesquisaCpfCadastro extends Controller
{
    public function index()
    {
        return Inertia::render('associado/pesquisaCpfCadastro/PesquisaCpfCadastro');
    }
}
