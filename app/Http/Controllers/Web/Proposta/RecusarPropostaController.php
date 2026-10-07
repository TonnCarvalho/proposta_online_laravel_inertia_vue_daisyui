<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Proposta\RecusarPropostaAction;
use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposta\RecusarPropostaRequest;
use App\Models\Proposta;
use App\Trait\AutorizacaoComRedirecionamento;
use Illuminate\Http\RedirectResponse;

class RecusarPropostaController extends Controller
{
    use AutorizacaoComRedirecionamento;

    public function __invoke(
        RecusarPropostaRequest $request,
        Proposta $proposta,
        RecusarPropostaAction $recusarPropostaAction
    ): RedirectResponse {

        if ($redirect = $this->handleDenied(
            'recusarProposta',
            $proposta,
            'acompanhamento.index',
            'Você não possui permissão para recusar está proposta',
            'error'
        )) {
            return $redirect;
        }
        $status = StatusProposta::from(0);

        $motivo = $request->string('motivo');

        $recusarPropostaAction->execute($proposta, $status, $motivo);

        return back()->with(
            'success',
            'Proposta recusada com sucesso'
        );
    }
}
