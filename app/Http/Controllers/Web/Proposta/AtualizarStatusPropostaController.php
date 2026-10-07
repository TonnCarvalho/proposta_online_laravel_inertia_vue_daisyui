<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Proposta\AtualizarStatusProposta;
use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposta\AtualizarStatusPropostaRequest;
use App\Models\Proposta;
use App\Trait\AutorizacaoComRedirecionamento;
use Illuminate\Http\RedirectResponse;

class AtualizarStatusPropostaController extends Controller
{
    use AutorizacaoComRedirecionamento;

    public function __invoke(
        AtualizarStatusPropostaRequest $request,
        Proposta $proposta,
        AtualizarStatusProposta $atualizarStatus,
    ): RedirectResponse {

        if ($redirect = $this->handleDenied(
            'atualizarStatus',
            $proposta,
            'acompanhamento.index',
            'Você não possui permissão para atualizar está proposta',
            'error'
        )) {
            return $redirect;
        }

            $status = StatusProposta::from(
                $request->integer('status')
            );

        $atualizarStatus->execute($proposta, $status);

        return back()->with(
            'success',
            'Situação da proposta atualizada com sucesso'
        );
    }
}
