<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaStoreRequest;
use App\Services\Proposta\PropostaStoreService;

class PropostaStoreController extends Controller
{
    public function store(PropostaStoreRequest $request, PropostaStoreService $propostaService)
    {
        $propostaService->criarProposta(
            $request->input('tipoCadastro'),
            $request->validated()
        );
    }
}
