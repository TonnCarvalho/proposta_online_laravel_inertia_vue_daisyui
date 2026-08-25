<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PropostaSucessoController extends Controller
{
    public function index()
    {
        $success = session('success');
        $dadosAssociado = session('dadosAssociado');
        $dadosProposta = session('dadosProposta');

        if (!$success) {
            return redirect()->route('proposta.index');
        }

        return Inertia::render('proposta/PaginaSucesso', [
            'dadosAssociado' => $dadosAssociado,
            'dadosProposta' => $dadosProposta
        ]);
    }
}
