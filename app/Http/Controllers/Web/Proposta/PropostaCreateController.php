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
    /**
     * 
     * Mostra os dados dos associados se já tiver registro no banco de dados.
     * Retorna a pagina para criação de proposta do associado novo ou existente.
     * @param OrigemQuery $origemQuery
     * @param string|null $tipoCadastro
     * @param integer|null $associado
     * @return void
     */
    public function create(
        OrigemQuery $origemQuery,
        ?string $tipoCadastro = null,
        ?int $associado = null
    ) {
        //Se o associado não existir, usa para preencher o input CPF
        $cpf = session('proposta.cpf_pesquisado');

        //Se não tiver cpf e associado, redireciona para pagina.
        if (!$cpf && !$associado) {
            return redirect()
                ->route('pesquisaCpfCadastro.index')->with('flash', [
                    'message' => 'CPF não informado!'
                ]);
        }

        $data = null;
        $idAssociado = null;

        //Se o associado existe, busca os dados pelo id do associado
        if ($associado) {
            $idAssociado = $associado;
            $data = Associado::query()
                ->findOrFail($associado);
        }

        //Pega as praças ativas para mostrar no cadastro
        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();

        //Pega as formas de pagamentos e mostra no cadastro.
        $fontePagamento = FontePagamento::select(['id', 'fonte'])
            ->get();
            
        return Inertia::render('proposta/Criar', [
            'idAssociado' => $idAssociado,
            'data' => $data,
            'cpf' => $cpf,
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
