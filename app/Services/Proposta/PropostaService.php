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
}
