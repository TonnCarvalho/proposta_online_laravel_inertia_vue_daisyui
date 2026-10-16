<?php

namespace App\Http\Controllers\Web\ClickSign;

use App\Http\Controllers\Controller;
use App\Queries\ClickSignQuery;
use App\Services\ClickSign\EnviarPropostaParaClickSignService;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Recebe a requisição, valida e autoriza, chama o service e devolve a resposta
 */
class ClickSignEnviarController extends Controller
{
    public function enviarView(
        ClickSignQuery $clickSignQuery
    ) {
        $propostas = $clickSignQuery->propostasParaEnvio();

        return Inertia::render('clicksign/enviar/Enviar', [
            'propostas' => $propostas
        ]);
    }

    public function processarEnvelope(
        Request $request,
        EnviarPropostaParaClickSignService $enviarPropostaParaClickSignService,
    ) {
        $idProposta = $request->integer('propostaId');

        $enviarPropostaParaClickSignService->executar($idProposta);
    }
}
