<?php

namespace App\Http\Controllers\Web\Acompanhamento;

use App\Enum\StatusProposta;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Queries\AcompanhamentoQuery;
use Inertia\Inertia;

class AcompanhamentoIndexController extends Controller
{
    public function index(
        AcompanhamentoQuery $acompanhamentoQuery,
    ) {
        $propostas = $acompanhamentoQuery->propostas()
            ->paginate(10);

        return Inertia::render('acompanhamento/Index', [
            'propostas' => $propostas,
            'statusProposta' => StatusProposta::option(),
            'tipoProposta' => TipoProposta::option(),
        ]);
    }
}
