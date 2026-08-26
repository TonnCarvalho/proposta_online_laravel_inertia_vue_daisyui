<?php

namespace App\Action\Proposta;

use Illuminate\Support\Facades\Auth;

class MontarDadosProposta
{

    public function execute(array $dados): array
    {
        return [
            'id_usuario' => Auth::user()->id_usuario,
            'id_proposta' => $dados['idProposta'] ?? null,
            'id_fonte_pagamento' => $dados['financeiro']["fonte_pagamento"] ?? null,
            'cod_local' => $dados['associado']['cod_local'],
            'cod_corretor' => $dados['financeiro']["cod_corretor"],
            'data_proposta' => $dados['financeiro']["data_proposta"],
            'valor_financiado' => $dados['financeiro']["valor_financiado"],
            'valor_liberado' => $dados['financeiro']["valor_liberado"] ?? null,
            'valor_parcela' => $dados['financeiro']["valor_parcela"],
            'valor_mensalidade' => $dados['financeiro']["valor_mensalidade"],
            'prazo' => $dados['financeiro']["prazo"],
            'tipo_proposta' => $dados['financeiro']["tipo_proposta"] ?? null,
            'iof' => $dados['financeiro']["iof"] ?? null,
            'taxa' => $dados['financeiro']["taxa"] ?? null,
        ];
    }
}
