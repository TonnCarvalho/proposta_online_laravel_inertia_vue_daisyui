<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'cod_local',
    'nome',
    'inativo',
])]

#[Table('origem')]
#[WithoutTimestamps]
class Origem extends Model
{

    protected $primaryKey = 'cod_local';

    public function associado(): HasMany
    {
        return $this->hasMany(Associado::class, 'id_origem');
    }

    public function consulta(): HasMany
    {
        return $this->hasMany(Consulta::class, 'id_origem');
    }

    public function orgao(): HasMany
    {
        return $this->hasMany(Orgao::class, 'id_origem');
    }

    public function proposta(): HasMany
    {
        return $this->hasMany(Proposta::class, 'id_proposta');
    }
}
