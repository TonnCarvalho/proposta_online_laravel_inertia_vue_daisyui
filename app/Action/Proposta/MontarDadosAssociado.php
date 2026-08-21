<?php

namespace App\Action\Proposta;

use Illuminate\Support\Facades\Auth;

class MontarDadosAssociado
{
    public function execute(array $dados): array
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
}
