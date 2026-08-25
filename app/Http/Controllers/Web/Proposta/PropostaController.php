<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Queries\OrigemQuery;
use App\Services\Proposta\PropostaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropostaController extends Controller
{
    public function index(
        PropostaService $propostaService,
        OrigemQuery $origemQuery,
        Request $request
    ) {
        $filtros = $request->only([
            'search',
            'origem',
            'status',
        ]);

        $propostas = $propostaService->listaPropostas($filtros);

        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->get();

        return Inertia::render('proposta/Index', [
            'propostas' => $propostas,
            'origens' => $origens,
            'statusProposta' => StatusProposta::option(),
            'filtros' => $filtros
        ]);
    }
}
