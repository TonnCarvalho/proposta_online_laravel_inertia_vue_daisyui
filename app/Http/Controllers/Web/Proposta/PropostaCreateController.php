<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PropostaCreateController extends Controller
{
    public function create() 
    {
        return Inertia::render('proposta/criar/Criar');
    }
}
