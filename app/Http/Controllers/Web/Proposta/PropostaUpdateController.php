<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaRequest;
use App\Models\Proposta;
use App\Services\Proposta\PropostaUpdateService;
use App\Trait\AutorizacaoComRedirecionamento;
use Illuminate\Http\RedirectResponse;

class PropostaUpdateController extends Controller
{
    use AutorizacaoComRedirecionamento;

    public function update(
        PropostaRequest $request,
        Proposta $proposta,
        PropostaUpdateService $propostaUpdateService
    ): RedirectResponse {

        if ($redirect = $this->handleDenied(
            'update',
            $proposta,
            'proposta.index',
            'Você não possui permissão para atualizar está proposta',
            'error'
        )) {
            return $redirect;
        }

        $propostaUpdateService->atualizarProposta(
            $request->validated()
        );

        return redirect()
            ->back()
            ->with('flash', [
                'message' => 'Atualizado com sucesso.',
                'subMessage' => 'Dados da proposta e do associado foram atualizados com sucesso.',
            ]);
    }
}
