<?php

namespace App\Http\Controllers\Web\Acompanhamento;

use App\Enum\StatusProposta;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Queries\AcompanhamentoQuery;
use App\Queries\OrigemQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcompanhamentoIndexController extends Controller
{
    public function index(
        AcompanhamentoQuery $acompanhamentoQuery,
        OrigemQuery $origemQuery,
        Request $request,
    ) {
        $filtros = $request->only([
            'pesquisa',
            'corretor',
            'situacao',
            'assinatura',
            'origem',
            'tipo'
        ]);

        $propostas = $acompanhamentoQuery->propostas($filtros);

        $pracaAtiva = $origemQuery->pracasAtivas()->get();

        return Inertia::render('acompanhamento/Index', [
            'propostas' => $propostas,
            'pracaAtiva' => $pracaAtiva,
            'statusProposta' => StatusProposta::option(),
            'tipoProposta' => TipoProposta::option(),
            'filtros' => $filtros,
        ]);
    }
}
