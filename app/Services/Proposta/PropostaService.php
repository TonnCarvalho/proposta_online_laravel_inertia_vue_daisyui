<?php

namespace App\Services\Proposta;

use App\Models\Proposta;
use App\Queries\PropostaQuery;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PropostaService
{
    public function listaPropostas(array $filtros)
    {
        // TODO CRIAR REGRA DE NEGOCIO PARA MOSTRAR PROPOSTA PARA CORRETOR OU ADMIN

        return app(PropostaQuery::class)
            ->listaProposta($filtros);
    }

    public function criarProposta(string $tipoCadastro, array $dados): Proposta
    {
        return DB::transaction(function () use ($tipoCadastro, $dados) {
            return match ($tipoCadastro) {
                'novo_associado' => $this->cadastrarNovoAssociado(),

                'nova_matricula' => $this->cadastrarNovaMatricula(),

                'matricula_existente' => $this->cadastrarComMatriulaExistente($dados),

                default => throw ValidationException::withMessages([
                    'tipo' => 'Tipo de cadastrdo inválido',
                ]),
            };
        });
    }

    private function montarDadosAssociado(array $dados): array
    {
        return [
            'nome' => $dados['associado']['nome'],
            'cod_local' => $dados['associado']['cod_local'],
            'cod_corretor' => $dados['financeiro']['cod_corretor'],
            'cpf' => $dados['associado']['cpf'],
            'rg' => $dados['associado']['rg'],
            'orgao_exp' => $dados['associado']['orgao_exp'],
            'email' => $dados['associado']['email'],
            'data_nasc' => $dados['associado']['data_nasc'],
            'nat' => $dados['associado']['nat'],
            'sexo' => $dados['associado']['sexo'],
            'cel' => $dados['associado']['cel'],
            'nome_pai' => $dados['associado']['nome_pai'],
            'nome_mae' => $dados['associado']['nome_mae'],
            'estado_civil' => $dados['associado']['estado_civil'],
            'mat' => $dados['associado']['mat'],
            'cod_orgao' => $dados['associado']['cod_orgao'],
            'setor' => $dados['associado']['setor'],
            'cargo' => $dados['associado']['cargo'],
            'ocupacao' => $dados['associado']['ocupacao'],
            'data_admissao' => $dados['associado']['data_admissao'],

            'cep' => $dados['endereco']["cep"],
            'uf' => $dados['endereco']["uf"],
            'municipio' => $dados['endereco']["municipio"],
            'bairro' => $dados['endereco']["bairro"],
            'endereco' => $dados['endereco']["endereco"],

            'banco' => $dados['bancoContraCheque']["banco"],
            'agencia' => $dados['bancoContraCheque']["agencia"],
            'conta' => $dados['bancoContraCheque']["conta"],

            'chave_pix' => $dados['bancoRecebimento']["chave_pix"] ?? NULL,
            'banco_pagamento' => $dados['bancoRecebimento']["banco_pagamento"],
            'agencia_pagamento' => $dados['bancoRecebimento']["agencia_pagamento"],
            'conta_pagamento' => $dados['bancoRecebimento']["conta_pagamento"],
            'tipo_bancario' => $dados['bancoRecebimento']["tipo_bancario"],
        ];
    }

    private function montarDadosProposta(array $dados): array
    {
        return [
            'cod_corretor' => $dados['financeiro']["cod_corretor"],
            'data_proposta' => $dados['financeiro']["data_proposta"],
            'valor_financiado' => $dados['financeiro']["valor_financiado"],
            'valor_liberado' => $dados['financeiro']["valor_liberado"] ?? NULL,
            'valor_parcela' => $dados['financeiro']["valor_parcela"],
            'valor_mensalidade' => $dados['financeiro']["valor_mensalidade"],
            'prazo' => $dados['financeiro']["prazo"],
            'tipo_proposta' => $dados['financeiro']["tipo_proposta"] ?? NULL,
            'iof' => $dados['financeiro']["iof"] ?? NULL,
            'fonte_pagamento' => $dados['financeiro']["fonte_pagamento"] ?? NULL,
        ];
    }

    private function cadastrarNovoAssociado()
    {
        dd('cadastrarNovoAssociado');
    }
    private function cadastrarNovaMatricula()
    {
        dd('cadastrarNovaMatricula');
    }
    private function cadastrarComMatriulaExistente(array $dados)
    {
        dd(
            $this->montarDadosAssociado($dados),
            $this->montarDadosProposta($dados)
        );      
    }
}
