<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class AcompanhamentoQuery
{
    public function propostas(array $filtros)
    {
        $query = DB::table('propostas')
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
                'propostas.status_recusado',
                'associados.nome AS associado_nome',
                'associados.cpf',
                'origem.nome AS origem_nome',
                'orgaos.nome AS orgaos_nome',
                'usuarios.nome AS usuarios_nome_acompanhamento',
                'acompanhamento.id_usuario AS acompanhamento_id_usuario'
            ]);

        $this->filtroPesquisa($query, $filtros['pesquisa'] ?? null);
        $this->filtroCorretor($query, $filtros['corretor'] ?? null);
        $this->filtroSituacao($query, $filtros['situacao'] ?? null);
        $this->filtroAssinatura($query, $filtros['assinatura'] ?? null);
        $this->filtroOrigem($query, $filtros['origem'] ?? null);
        $this->filtroTipoProposta($query, $filtros['tipo'] ?? null);

        return $query
            ->orderByDesc('propostas.id_proposta')
            ->paginate(10)
            ->appends($filtros);
    }

    private function filtroPesquisa(object $query, ?string $pesquisa): void
    {
        $query->when(
            $pesquisa,
            function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('propostas.num_proposta', 'like', "{$pesquisa}%")
                        ->orWhere('associados.nome', 'like', "{$pesquisa}%");
                });
            }
        );
    }

    private function filtroCorretor(object $query, ?string $codigoCorretor): void
    {
        $query->when(
            $codigoCorretor,
            function ($query) use ($codigoCorretor) {
                $query->where('propostas.cod_corretor', '=', "$codigoCorretor");
            }
        );
    }

    private function filtroSituacao(object $query, ?string $situacao): void
    {
        $query->when(
            $situacao,
            function ($query) use ($situacao) {
                $query->where('propostas.status_proposta', '=', "$situacao");
            }
        );
    }

    private function filtroAssinatura(object $query, ?string $assinatura): void
    {
        $query->when(
            $assinatura,
            function ($query) use ($assinatura) {
                $query->where('propostas.status_assinatura', '=', "$assinatura");
            }
        );
    }

    private function filtroOrigem(object $query, ?string $origem): void
    {
        $query->when(
            $origem,
            function ($query) use ($origem) {
                $query->where('propostas.cod_local', '=', "$origem");
            }
        );
    }

    private function filtroTipoProposta(object $query, ?string $tipoProposta): void
    {
        $query->when(
            $tipoProposta,
            function ($query) use ($tipoProposta) {
                $query->where('propostas.tipo_proposta', '=', "$tipoProposta");
            }
        );
    }
}
