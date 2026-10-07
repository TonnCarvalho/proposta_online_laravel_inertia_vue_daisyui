<?php

namespace App\Action\Proposta;

use App\Enum\StatusProposta;
use App\Models\Proposta;

class AtualizarStatusProposta
{
    public function execute(
        Proposta $proposta,
        StatusProposta $statusProposta,
    ): Proposta {

        $proposta->update([
            'status_proposta' => $statusProposta->value,
        ]);

        return $proposta->refresh();
    }
}
