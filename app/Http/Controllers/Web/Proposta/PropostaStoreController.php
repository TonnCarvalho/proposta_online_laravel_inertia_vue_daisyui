<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaRequest;
use App\Models\Origem;
use App\Services\Proposta\PropostaStoreService;
use Illuminate\Http\RedirectResponse;

class PropostaStoreController extends Controller
{
    public function store(
        PropostaRequest $request,
        PropostaStoreService $propostaStoreService
    ) {
        $resultado = $propostaStoreService->criarProposta(
            $request->input('tipoCadastro'),
            $request->validated()
        );

        return $this->success($resultado);
    }

    private function success(array $resultado): RedirectResponse
    {
        //Dados para mostrar na página de sucesso.
        $associado = $resultado['associado'];
        $proposta = $resultado['proposta'];

        $praca = Origem::select('nome')
            ->where('cod_local', $proposta->cod_local)
            ->get();

        $dadosAssociado = [
            'nome' => $associado->nome,
            'cpf' => $associado->cpf,
            'mat' => $associado->mat,
            'cel' => $associado->cel,
            'email' => $associado->email
        ];

        $dadosProposta = [
            'praca' => $praca[0]['nome'],
            'id_proposta' => $proposta->id_proposta,
            'num_proposta' => $proposta->num_proposta,
            'valor_financiado' => $proposta->valor_financiado,
            'valor_liberado' => $proposta->valor_liberado,
            'valor_parcela' => $proposta->valor_parcela,
            'prazo' => $proposta->prazo,
        ];

        return redirect()
            ->route('proposta.sucesso')
            ->with([
                'success' => true,
                'dadosAssociado' => $dadosAssociado,
                'dadosProposta' => $dadosProposta
            ]);
    }
}
