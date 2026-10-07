<?php

namespace App\Http\Controllers\Web\ClickSign;

use App\Http\Controllers\Controller;
use App\Queries\ClickSignQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClickSignEnviarController extends Controller
{
    public function enviar(
        ClickSignQuery $clickSignQuery
    ) {
        $propostas = $clickSignQuery->propostasParaEnvio();

        return Inertia::render('clicksign/enviar/Enviar', [
            'propostas' => $propostas
        ]);
    }
}
