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

        $tiposPermitidos = [
            'novo_associado',
            'nova_matricula',
            'matricula_existente'
        ];

        //Verifica se o tipo de cadastro é permitido.
        if (!in_array($tipoCadastro, $tiposPermitidos)) {
            return redirect()
                ->route('pesquisaCpfCadastro.index')
                ->with('flash', [
                    'message' => 'Tipo de cadastro inválido!'
                ]);
        }

        $cpf = session('proposta.cpf_pesquisado');

        /**
         * NOVO ASSOCIADO
         * Neste caso precisamos obrigatoriamente do CPF
         * que oi armazenado anteriormente na sessão.
         */

        if ($tipoCadastro === 'novo_associado' && !$cpf) {
            return redirect()
                ->route('pesquisaCpfCadastro.index')
                ->with('flash', [
                    'message' => 'CPF não encontrado'
                ]);
        }

        /**
         * NOVA MATRÍCULA ou MATRÍCULA EXISTENTE
         * Nos dois casos precisamos saber qual é
         * o associado que foi selecionado
         */

        if (
            in_array($tipoCadastro, [
                'nova_matricula',
                'matricula_existente'
            ])
            && !$associado
        ) {
            return redirect()
                ->route('pesquisaCpfCadastro.index')
                ->with('flash', [
                    'message' => 'Associado não informado!'
                ]);
        }
        /**
         * Se recebeu um associado pela URL,
         * buscamos seus dados.
         */

        $idAssociado = null;
        $data = null;

        if ($associado) {
            $idAssociado = $associado;

            $data = match ($tipoCadastro) {
                'nova_matricula' => Associado::query()
                    ->select([
                        'nome',
                        'cpf',
                        'rg',
                        'orgao_exp',
                        'email',
                        'data_nasc',
                        'nat',
                        'sexo',
                        'cel',
                        'nome_pai',
                        'nome_mae',
                        'estado_civil',
                        'cep',
                        'uf',
                        'municipio',
                        'bairro',
                        'endereco',
                        'banco',
                        'agencia',
                        'conta',
                        'banco_pagamento',
                        'agencia_pagamento',
                        'conta_pagamento',
                        'tipo_bancario'
                    ])
                    ->findOrFail($associado),

                'matricula_existente' => Associado::query()
                    ->findOrFail($associado)
            };

            $cpf = $data->cpf;
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
}
