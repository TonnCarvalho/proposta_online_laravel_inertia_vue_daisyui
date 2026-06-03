<?php

namespace App\Services;

use App\Queries\PropostaQuery;

class PropostaService
{
    public function listaPropostas(
        string|null $search,
        int $codCorretor
    ) 
    {
        //TODO CRIAR REGRA DE NEGOCIO PARA MOSTRAR PROPOSTA PARA CORRETOR OU ADMIN
        return app(PropostaQuery::class)
        ->listaPropostaAdmin($search, $codCorretor);
    }
}
