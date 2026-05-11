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

    public function filtroPropostaPorNomeNumProposta(string|null $search=null)
    {
        return $this->query->where('num_proposta', 'like', '%'. $search . '%');
    }
}
