<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Queries\OrigemQuery;
use Inertia\Inertia;

class PropostaCreateController extends Controller
{
    public function create(OrigemQuery $origemQuery)
    {
        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();
        
        return Inertia::render('proposta/criar/Criar', [
            'origens' => $origens,
            'tipoProposta' => TipoProposta::option(),
        ]);
    }
}
