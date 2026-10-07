<?php

namespace App\Action\Proposta;

use App\Enum\StatusProposta;
use App\Models\Proposta;

class RecusarPropostaAction
{
    public function execute(
        Proposta $proposta,
        StatusProposta $statusProposta,
        String $motivo,
    ): Proposta {
        $proposta->update([
            'status_proposta' => $statusProposta->value,
            'recusado_motivo' => $motivo
        ]);

        return $proposta->refresh();
    }
}
