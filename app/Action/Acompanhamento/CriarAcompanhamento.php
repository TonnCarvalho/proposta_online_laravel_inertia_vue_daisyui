<?php

namespace App\Action\Acompanhamento;

use App\Models\Acompanhamento;
use Illuminate\Support\Facades\Auth;

class CriarAcompanhamento
{

    public function execute(int $idProposta, string $status): Acompanhamento
    {
        return Acompanhamento::create([
            'id_proposta' => $idProposta,
            'id_usuario' => Auth::user()->id_usuario,
            'status_proposta' => $status
        ]);
    }
}
