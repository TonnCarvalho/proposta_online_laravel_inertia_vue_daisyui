<?php

namespace App\Services\Proposta;

use App\Action\Proposta\MontarDadosAssociado;
use App\Action\Proposta\MontarDadosProposta;
use App\Models\Associado;
use App\Models\Proposta;

class PropostaUpdateService
{
    public function __construct(
        private MontarDadosAssociado $montarDadosAssociado,
        private MontarDadosProposta $montarDadosProposta,
    )
    {
    }
    public function atualizarProposta(array $dados): Array
    {
        //atualizar associado
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::findOrFail($dadosAssociado['id_associado']);
        $associado->update($dadosAssociado);

        //atualizar proposta
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $proposta = Proposta::findOrFail($dadosProposta['id_proposta']);
        $proposta->update($dadosProposta);

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
}
