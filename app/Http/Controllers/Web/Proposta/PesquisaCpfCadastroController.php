<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Models\Associado;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PesquisaCpfCadastroController extends Controller
{
    public function index()
    {
        return Inertia::render('associado/pesquisaCpfCadastro/PesquisaCpfCadastro');
    }

    public function pesquisarAssociado(Request $request)
    {

        $cpf = $request->cpf;

        $matriculas = Associado::query()
            ->select(['id_associado', 'nome', 'mat', 'cargo', 'cod_local', 'cod_orgao'])
            ->with([
                'origem:cod_local,nome',
                'orgao:cod_orgao,nome',
            ])
            ->where('cpf', $cpf)
            ->orderBy('id_associado', 'desc')
            ->get();

        session()->forget('cpf_pesquisado');

        if ($matriculas->isEmpty()) {
            session()->put('cpf_pesquisado', $cpf);

            return response()->json([
                'success' => true,
                'message' => 'Associado não encontrado',
                'redirect' => route('proposta.create', [
                    'tipoCadastro' => 'novo_associado'
                ])
            ]);
        };

        return response()->json([
            'success' => true,
            'message' => 'Pesquisa realizada com sucesso.',
            'data' => $matriculas,
        ], 200);
    }
}
