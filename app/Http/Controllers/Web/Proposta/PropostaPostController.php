<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropostaStoreRequest;
// use Illuminate\Http\Request;

class PropostaPostController extends Controller
{
    public function store(PropostaStoreRequest $request)
    {
        dd($request->input());
    }
}
