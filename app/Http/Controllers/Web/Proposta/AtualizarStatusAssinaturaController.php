<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Proposta\AtualizarStatusAssinatura;
use App\Enum\StatusAssinatura;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposta\AtualizarStatusAssinaturaRequest;
use App\Models\Proposta;
use App\Trait\AutorizacaoComRedirecionamento;

class AtualizarStatusAssinaturaController extends Controller
{
    use AutorizacaoComRedirecionamento;

    public function __invoke(
        AtualizarStatusAssinaturaRequest $request,
        Proposta $proposta,
        AtualizarStatusAssinatura $atualizarStatusAssinatura
    ) {
        if ($redirect = $this->handleDenied(
            'AtualizarStatus',
            $proposta,
            'acompanhamento.index',
            'Você não possui permissão para atualizar essa assinatura',
            'error'
        )) {
            return $redirect;
        }

        $statusAssinatura = StatusAssinatura::from(
            $request->integer('status')
        );

        $atualizarStatusAssinatura->execute($proposta, $statusAssinatura);

        return back()->with(
            'success',
            'Status da assinatura atualizado com sucesso'
        );
    }
}
