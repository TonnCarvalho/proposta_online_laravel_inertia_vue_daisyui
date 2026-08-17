<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PropostaSucessoController extends Controller
{
    public function index()
    {
        $success = session('success', 'Proposta criado com sucesso');
        $idProposta = session('idProposta', '14083') ?? null;
        
        if ($success === null) {
            return redirect()->route('proposta.index');
        }

        return Inertia::render('proposta/PaginaSucesso', [
            'success' => $success,
            'idProposta' => $idProposta
        ]);
    }
}
