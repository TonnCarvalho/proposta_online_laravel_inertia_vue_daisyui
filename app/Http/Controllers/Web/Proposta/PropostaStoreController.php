<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaStoreRequest;
use App\Services\Proposta\PropostaStoreService;

class PropostaStoreController extends Controller
{
    public function store(PropostaStoreRequest $request, PropostaStoreService $propostaService)
    {
        $proposta = $propostaService->criarProposta(
            $request->input('tipoCadastro'),
            $request->validated()
        );

        return redirect()
            ->route('proposta.sucesso')
            ->with([
                'success' => 'Proposta criado com sucesso.',
                'idProposta' => $proposta->id_proposta
            ]);
    }
}
