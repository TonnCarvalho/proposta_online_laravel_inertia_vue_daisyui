<?php

namespace App\Action\Proposta;

use App\Enum\StatusProposta;
use App\Models\Proposta;

class AtualizarStatusProposta
{
    public function execute(
        Proposta $proposta,
        StatusProposta $status,
    ): Proposta {

        $proposta->update([
            'status_proposta' => $status->value,
        ]);

        return $proposta->refresh();
    }
}
