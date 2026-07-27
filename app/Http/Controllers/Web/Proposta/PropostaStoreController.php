<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaStoreRequest;
use App\Services\Proposta\PropostaService;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class PropostaStoreController extends Controller
{
    public function store(PropostaStoreRequest $request, PropostaService $propostaService)
    {
        dd($request->all());
        $propostaService->criarProposta($request->query('tipo'),$request->validated());
    }
}
