<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class AcompanhamentoQuery
{
    public function propostas()
    {
        return DB::table('propostas')
            ->join(
                'associados',
                'associados.id_associado',
                '=',
                'propostas.id_associado'
            )
            ->join(
                'origem',
                'origem.cod_local',
                '=',
                'propostas.cod_local'
            )
            ->join(
                'orgaos',
                function ($join) {
                    $join->on(
                        'orgaos.cod_orgao',
                        '=',
                        'associados.cod_orgao'
                    );
                    $join->on(
                        'orgaos.cod_local',
                        '=',
                        'associados.cod_local'
                    );
                }
            )
            ->rightJoin(
                'acompanhamento',
                'acompanhamento.id_proposta',
                '=',
                'propostas.id_proposta'
            )
            ->leftJoin(
                'usuarios',
                'usuarios.id_usuario',
                '=',
                'acompanhamento.id_usuario'
            )
            ->select([
                'propostas.id_proposta',
                'propostas.id_usuario',
                'propostas.num_proposta',
                'propostas.status_proposta',
                'propostas.status_assinatura',
                'associados.nome AS associado_nome',
                'associados.cpf',
                'origem.nome AS origem_nome',
                'orgaos.nome AS orgaos_nome',
                'usuarios.nome AS usuarios_nome_acompanhamento',
                'acompanhamento.id_usuario AS acompanhamento_id_usuario'
            ])
            ->orderByDesc('propostas.id_proposta');
    }
}
