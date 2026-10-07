<?php

namespace App\Queries;

use App\Models\Proposta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ClickSignQuery
{
    private Builder $query;

    public function __construct()
    {
        $this->query = Proposta::query();
    }


    public function propostasParaEnvio()
    {
        $this->query
            ->select([
                'id_proposta',
                'id_associado',
                'cod_local',
                'num_proposta',
                'valor_financiado',
                'valor_mensalidade',
                'valor_parcela',
                'prazo',
                'data_proposta',
            ])
            ->with([
                'associado:id_associado,nome',
                'origem:cod_local,nome',
            ])
            ->where('status_proposta', '=', '5')
            ->where('status_assinatura', '=', '1');

        return $this->query
            ->orderByDesc('id_proposta')
            ->paginate(20)
            ->onEachSide(7);
    }
}
