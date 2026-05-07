<?php

namespace App\Queries;

use App\Models\Origem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrigemQuery
{
    private Builder $query;

    public function __construct()
    {
        $this->query = Origem::query();
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

    public function isActive(): Builder
    {
        return $this->query->where('ativo', 1 );

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
