<?php

namespace App\Http\Controllers\Api\Associado;

use App\Models\Associado;
use Illuminate\Http\Request;

class PesquisaAssociado
{
    public function pesquisar(Request $request)
    {
        $cpf = $request->cpf;

        $matriculas = Associado::query()
            ->select(['id_associado', 'nome', 'mat', 'cargo', 'cod_local', 'cod_orgao'])
            ->with([
                'origem:cod_local,nome',
                'orgao:cod_orgao,nome'
            ])
            ->where('cpf', $cpf)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $matriculas,
        ]);
    }
}
