<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\EstadoCivilAssociado;
use App\Enum\OcupacaoAssociado;
use App\Enum\SexoAssociado;
use App\Enum\TipoContaAssociado;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Models\Associado;
use App\Models\FontePagamento;
use App\Queries\OrigemQuery;
use Inertia\Inertia;

class PropostaCreateController extends Controller
{
    public function create(
        OrigemQuery $origemQuery,
        ?string $tipoCadastro = null,
        ?int $associado = null
    ) {
        $data = null;

        if ($associado) {
            $data = Associado::query()
                ->findOrFail($associado);
        }
        
        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();

        $fontePagamento = FontePagamento::select(['id', 'fonte'])
            ->get();

        return Inertia::render('proposta/Criar', [
            'data' => $data,
            'tipoCadastro' => $tipoCadastro,
            'origens' => $origens,
            'tipoProposta' => TipoProposta::option(),
            'sexoAssociado' => SexoAssociado::option(),
            'estadoCivilAssociado' => EstadoCivilAssociado::option(),
            'ocupacaoAssociado' => OcupacaoAssociado::option(),
            'tipoContaAssociado' => TipoContaAssociado::option(),
            'fontePagamento' => $fontePagamento,
        ]);
    }

    public function sucess()
    {
        return Inertia::render('proposta/Sucesso');
    }
}
