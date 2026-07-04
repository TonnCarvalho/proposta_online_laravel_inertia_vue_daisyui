<?php

namespace App\Queries;

use App\Models\Proposta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PropostaQuery
{
    private Builder $query;

    public function __construct()
    {
        $this->query = Proposta::query();
    }

    /**
     * Seleciona as colunas no database
     */
    public function select(array $columns): self
    {
        $this->query->select($columns);

        return $this;
    }

    public function where(string $column, string $operador, string $value): self
    {
        $this->query->where($column, $operador, $value);

        return $this;
    }

    public function paginate(int $pages)
    {
        return $this->query->paginate($pages);
    }

    public function get(): Collection
    {
        return $this->query->get();
    }

    public function withQueryString(): self
    {
        return $this->query->withQueryString();
    }

    public function with(array $relations): self
    {
        $this->query->with($relations);

        return $this;
    }

    public function listaProposta(
        array $filtros
    ) {
        $this->query
            ->select([
                'id_proposta',
                'id_associado',
                'cod_local',
                'num_proposta',
                'cod_corretor',
                'status_proposta',
                'data_proposta',
            ])
            ->with([
                'associado:id_associado,nome',
                'origem:cod_local,nome',
            ]);
        $this->filtroPesquisa($filtros['search'] ?? null);
        $this->filtroOrigem($filtros['origem'] ?? null);
        $this->filtroStatus($filtros['status'] ?? null);

        return $this->query
            ->orderByDesc('id_proposta')
            ->paginate(20)
            ->onEachSide(7)
            ->appends($filtros);
    }

    private function filtroPesquisa(?string $pesquisa): self
    {
        $this->query->when(
            ! empty($pesquisa),
            function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('num_proposta', 'like', "{$pesquisa}%")
                        ->orWhereHas('associado', function ($associado) use ($pesquisa) {
                            $associado->where('nome', 'like', "{$pesquisa}%");
                        });
                });
            }
        );

        return $this;
    }

    private function filtroOrigem(?string $origem): self
    {
        $this->query->when(
            ! empty($origem),
            function ($query) use ($origem) {
                $query->where('cod_local', $origem);
            }
        );

        return $this;
    }

    private function filtroStatus(?string $status): self
    {
        $this->query->when(
            ! empty($status),
            function ($query) use ($status) {
                $query->where('status_proposta', $status);
            }
        );

        return $this;
    }
}
