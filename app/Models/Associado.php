<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'id_usuario',
    'cod_local',
    'cod_corretor',
    'nome',
    'cpf',
    'rg',
    'orgao_exp',
    'data_nasc',
    'nat',
    'sexo',
    'estado_civil',
    'tel',
    'cel',
    'email',
    'nome_pai',
    'nome_mae',
    'mat',
    'cod_orgao',
    'setor',
    'cargo',
    'ocupacao',
    'data_admissao',
    'cep',
    'uf',
    'municipio',
    'bairro',
    'endereco',
    'banco',
    'agencia',
    'conta',
    'chave_pix',
    'banco_pagamento',
    'agencia_pagamento',
    'conta_pagamento',
    'tipo_bancario',
    'inativo',
])]
#[WithoutTimestamps]
class Associado extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_associado';

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class, 'id_origem');
    }

    public function orgao(): BelongsTo
    {
        return $this->belongsTo(Orgao::class, 'id_orgao');
    }

    public function proposta(): HasMany
    {
        return $this->hasMany(Proposta::class, 'id_proposta');
    }

    public function associado(): HasMany
    {
        return $this->hasMany(Associado::class, 'id_associado');
    }
}
