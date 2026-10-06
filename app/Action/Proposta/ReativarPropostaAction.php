<?php

namespace App\Action\Proposta;

use App\Enum\StatusProposta;
use App\Models\Proposta;

class ReativarPropostaAction
{
    public function execute(
        Proposta $proposta,
        StatusProposta $statusProposta,
    ): Proposta {
        $proposta->update([
            'status_proposta' => $statusProposta->value,
            'status_assinatura' => 1,
            'recusado_motivo' => null
        ]);

        return $proposta->refresh();
    }
}
