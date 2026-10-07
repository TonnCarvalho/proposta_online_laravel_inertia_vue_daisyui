<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Proposta\ReativarPropostaAction;
use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposta\AtualizarStatusPropostaRequest;
use App\Models\Proposta;
use App\Trait\AutorizacaoComRedirecionamento;
use Illuminate\Http\RedirectResponse;

class ReativarPropostaController extends Controller
{
    use AutorizacaoComRedirecionamento;

    public function __invoke(
        Proposta $proposta,
        ReativarPropostaAction $reativarPropostaAction,
    ): RedirectResponse {
        if ($redirect = $this->handleDenied(
            'AtualizarStatus',
            $proposta,
            'acompanhamento.index',
            'Você não possui permissão para atualizar está proposta',
            'error'
        )) {
            return $redirect;
        }

        $status = StatusProposta::from(1);

        $reativarPropostaAction->execute(
            $proposta,
            $status
        );

        return back()->with('success', 'Proposta Reativar com sucesso');
    }
}
