<?php

namespace App\Action\Proposta;

use App\Enum\StatusAssinatura;
use App\Models\Proposta;

class AtualizarStatusAssinatura
{
    public function execute(
        Proposta $proposta,
        StatusAssinatura $statusAssinatura
    ): Proposta {
        $proposta->update([
            'status_assinatura' => $statusAssinatura->value
        ]);

        return $proposta->refresh();
    }
}
