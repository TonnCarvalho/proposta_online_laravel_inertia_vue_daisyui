<?php

namespace App\Services\Proposta;

use App\Queries\PropostaQuery;

class PropostaService
{
    public function listaPropostas(array $filtros)
    {
        // TODO CRIAR REGRA DE NEGOCIO PARA MOSTRAR PROPOSTA PARA CORRETOR OU ADMIN

        return app(PropostaQuery::class)
            ->listaProposta($filtros);
    }

    public function criar(array $dados): void
    {
        $associado = $dados['associado'];
        $nome = $associado['nome'];
        $cod_local = $associado['cod_local'];
        $cpf = $associado['cpf'];
        $rg = $associado['rg'];
        $org_exp = $associado['org_exp'];
        $email = $associado['email'];
        $data_nasc = $associado['data_nasc'];
        $nat = $associado['nat'];
        $sexo = $associado['sexo'];
        $cel = $associado['cel'];
        $nome_pai = $associado['nome_pai'];
        $nome_mae = $associado['nome_mae'];
        $estado_civil = $associado['estado_civil'];
        $mat = $associado['mat'];
        $cod_orgao = $associado['cod_orgao'];
        $setor = $associado['setor'];
        $cargo = $associado['cargo'];
        $ocupacao = $associado['ocupacao'];
        $data_admissao = $associado['data_admissao'];

        $financiado = $dados['financiado'];
        dd($financiado);
    }
}
