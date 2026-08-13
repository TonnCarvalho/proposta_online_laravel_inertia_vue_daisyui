<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaStoreRequest;
use App\Services\Proposta\PropostaService;

class PropostaStoreController extends Controller
{
    public function store(PropostaStoreRequest $request, PropostaService $propostaService)
    {
        $propostaService->criarProposta(
            $request->input('tipoCadastro'),
            $request->validated()
        );
    }
}
