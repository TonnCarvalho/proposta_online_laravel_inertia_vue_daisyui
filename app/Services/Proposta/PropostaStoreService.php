<?php

namespace App\Services\Proposta;

use App\Models\Acompanhamento;
use App\Models\Associado;
use App\Models\Proposta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PropostaStoreService
{
    public function criarProposta(string $tipoCadastro, array $dados): array
    {
        return DB::transaction(function () use ($tipoCadastro, $dados) {
            return match ($tipoCadastro) {
                'novo_associado' => $this->cadastrarNovoAssociado($dados),

                'nova_matricula' => $this->cadastrarNovaMatricula($dados),

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
            'id_usuario' => Auth::user()->id_usuario,
            'id_associado' => $dados['idAssociado'],
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
            'id_usuario' => Auth::user()->id_usuario,
            'cod_local' => $dados['associado']['cod_local'],
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

    private function cadastrarNovoAssociado(array $dados): array
    {
        //cadastra associado.
        $dadosAssociado = $this->montarDadosAssociado($dados);

        $associado = Associado::create($dadosAssociado);

        //cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        //adicionado ao acompanhamento
        Acompanhamento::create([
            'id_proposta' => $proposta->id_proposta,
            'id_usuario' => Auth::user()->id_usuario,
            'status_proposta' => 'em andamento',
        ]);

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
    private function cadastrarNovaMatricula(array $dados)
    {
        dd('cadastrarNovaMatricula');
    }
    private function cadastrarComMatriulaExistente(array $dados): array
    {
        //atualizar associado.
        $dadosAssociado = $this->montarDadosAssociado($dados);

        $associado = Associado::findOrFail($dadosAssociado['id_associado']);
        $associado->update($dadosAssociado);

        //cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        //adicionado ao acompanhamento
        Acompanhamento::create([
            'id_proposta' => $proposta->id_proposta,
            'id_usuario' => Auth::user()->id_usuario,
            'status_proposta' => 'em andamento',
        ]);

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
}
