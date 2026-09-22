<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Action\Proposta\AtualizarStatusProposta;
use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposta\AtualizarStatusPropostaRequest;
use App\Models\Proposta;

class AtualizarStatusPropostaController extends Controller
{
    public function __invoke(
        AtualizarStatusPropostaRequest $request,
        Proposta $proposta,
        AtualizarStatusProposta $atualizarStatus,
    ) {

        // $this->authorize('atualizarStatus', $proposta);

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
