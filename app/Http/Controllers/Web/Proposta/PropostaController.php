<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\StatusProposta;
use App\Http\Controllers\Controller;
use App\Queries\OrigemQuery;
use App\Services\PropostaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        PropostaService $propostaService,
        OrigemQuery $origemQuery,
        Request $request
    ) {
        $filters = $request->only([
            'search',
            'origem',
            'status',
        ]);

        $propostas = $propostaService->listaPropostas($filters);

        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->get();

        return Inertia::render('proposta/Proposta', [
            'propostas' => $propostas,
            'origens' => $origens,
            'statusProposta' => StatusProposta::option()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
