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

    public function filtroPropostaPorNumeroProposta(?string $search = null)
    {
        return $this->query->where('num_proposta', 'like', '%'.$search.'%');
    }

    public function listaPropostaAdmin(
        ?string $search,
        int $codCorretor
    ) {
        return Proposta::query()
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
            ])
            ->where('num_proposta', 'like', '%'.$search.'%')
            ->orderByDesc('id_proposta')
            ->paginate(20);
    }

    public function listaPropostaCorretor(
        ?string $search,
        int $codCorretor
    ) {
        return Proposta::query()
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
            ])
            ->where('cod_corretor', '=', $codCorretor)
            ->where('num_proposta', 'like', '%'.$search.'%')
            ->orderByDesc('id_proposta')
            ->paginate(20);
    }
}
