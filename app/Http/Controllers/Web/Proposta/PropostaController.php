<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\EstadoCivilAssociado;
use App\Enum\OcupacaoAssociado;
use App\Enum\SexoAssociado;
use App\Enum\StatusProposta;
use App\Enum\TipoContaAssociado;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Models\FontePagamento;
use App\Models\Proposta;
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

    public function edit(Proposta $id_proposta, OrigemQuery $origemQuery)
    {
        $proposta = $id_proposta::query()
            ->select('*')
            ->where('id_proposta', $id_proposta->id_proposta)
            ->with('associado')
            ->get();

        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();

        $fontePagamento = FontePagamento::select(['id', 'fonte'])
            ->get();

        return Inertia::render('proposta/Editar', [
            'proposta' => $proposta,
            'origens' => $origens,
            'tipoProposta' => TipoProposta::option(),
            'sexoAssociado' => SexoAssociado::option(),
            'estadoCivilAssociado' => EstadoCivilAssociado::option(),
            'ocupacaoAssociado' => OcupacaoAssociado::option(),
            'tipoContaAssociado' => TipoContaAssociado::option(),
            'fontePagamento' => $fontePagamento,
        ]);
    }
}
