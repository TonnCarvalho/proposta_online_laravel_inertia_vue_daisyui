<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaRequest;
use App\Services\Proposta\PropostaUpdateService;
use Illuminate\Http\RedirectResponse;

class PropostaUpdateController extends Controller
{
    public function update(
        PropostaRequest $request,
        PropostaUpdateService $propostaUpdateService
    ): RedirectResponse {

        $resultado = $propostaUpdateService->atualizarProposta(
            $request->validated()
        );

        return redirect()
            ->back()
            ->with('flash', [
                'message' => 'Atualizado com sucesso.',
                'subMessage' => 'Dados da proposta e do associado foram atualizados com sucesso.'
            ]);
    }
}
