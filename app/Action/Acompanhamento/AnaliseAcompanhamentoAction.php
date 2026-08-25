<?php

namespace App\Action\Acompanhamento;

use App\Models\Acompanhamento;
use App\Models\Proposta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnaliseAcompanhamentoAction
{

    public function execute(int $idProposta)
    {
        $proposta = Proposta::findOrFail($idProposta, ['id_proposta', 'status_proposta']);

        $statusProposta = $proposta['status_proposta'];

        if ($statusProposta !== 1) {
            return;
        }

        $idProposta = $proposta['id_proposta'];

        return Acompanhamento::query()
            ->where('id_proposta', $idProposta)
            ->update([
                'id_conferente' => Auth::user()->id_usuario,
                'status_proposta' => 'em analise',
                'data_status' => Carbon::now()
            ]);
    }
}
