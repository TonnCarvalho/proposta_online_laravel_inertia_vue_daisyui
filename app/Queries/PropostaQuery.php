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
     *
     * @param array $columns
     * @return self
     */
    public function select(array $columns): self
    {
        $this->query->select($columns);

        return $this;
    }

    public function get(): Collection
    {
        return $this->query->get();
    }

    public function with(array $relations): self
    {
         $this->query->with($relations);
         
         return $this;
    }
}
