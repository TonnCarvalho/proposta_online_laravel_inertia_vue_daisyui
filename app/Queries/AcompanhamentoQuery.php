<?php

namespace App\Queries;

use App\Models\Proposta;

class AcompanhamentoQuery
{
    public function propostas()
    {
        return Proposta::query()
            ->select([
                'id_proposta',
                'id_associado',
                'num_proposta',
                'status_proposta',
                'status_assinatura',
            ])
            ->with([
                'associado' => function ($q) {
                    $q->select([
                        'id_associado',
                        'cod_local',
                        'cod_orgao',
                        'nome',
                        'cpf',
                    ]);
                },
                'associado.origem' => function ($q) {
                    $q->select([
                        'cod_local',
                        'nome',
                    ]);
                },
                'associado.orgao' => function ($q) {
                    $q->select([
                        'cod_orgao',
                        'nome',
                    ]);
                },
                'ultimoAcompanhamento' => function ($q) {
                    $q->select([
                        'acompanhamento.id_proposta',
                        'acompanhamento.id_conferente',
                        'acompanhamento.data_status'
                    ]);
                },
            ])
            ->orderByDesc('num_proposta');
    }
}
