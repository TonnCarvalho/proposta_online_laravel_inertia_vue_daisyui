<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Acompanhamento\AnaliseAcompanhamentoAction;
use App\Enum\EstadoCivilAssociado;
use App\Enum\OcupacaoAssociado;
use App\Enum\SexoAssociado;
use App\Enum\TipoContaAssociado;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Models\FontePagamento;
use App\Models\Proposta;
use App\Queries\OrigemQuery;
use Inertia\Inertia;

class PropostaEditController extends Controller
{
    public function __construct(
        private AnaliseAcompanhamentoAction $analiseAcompanhamentoAction
    ) {}
    public function edit(Proposta $id_proposta, OrigemQuery $origemQuery)
    {

        $proposta = $id_proposta::query()
            ->select('*')
            ->where('id_proposta', $id_proposta->id_proposta)
            ->with('associado')
            ->get();

        $idAssociado = $proposta[0]['id_associado'];
        $idProposta = $proposta[0]['id_proposta'];

        $this->analiseAcompanhamentoAction->execute($idProposta);

        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();

        $fontePagamento = FontePagamento::select(['id', 'fonte'])
            ->get();

        return Inertia::render('proposta/Editar', [
            'idAssociado' => $idAssociado,
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
