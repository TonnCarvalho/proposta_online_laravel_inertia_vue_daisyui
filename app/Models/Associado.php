<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'id_usuario',
    'id_origem',
    'id_orgao',
    'cod_corretor',
    'nome',
    'sobrenome',
    'cpf',
    'rg',
    'orgao_exp',
    'data_nasc',
    'naturalidade',
    'sexo',
    'estado_civil',
    'ddd_tel',
    'tel',
    'ddd_cel',
    'cel',
    'email',
    'nome_pai',
    'nome_mae',
    'matricula',
    'setor',
    'cargo',
    'ocupacao',
    'data_admissao',
    'cep',
    'uf',
    'localidade',
    'bairro',
    'logradouro',
    'numero',
    'complemento',
    'banco',
    'agencia',
    'digito_agencia',
    'conta',
    'digito_conta',
    'banco_pagamento',
    'agencia_pagamento',
    'digito_agencia_pagamento',
    'conta_pagamento',
    'digito_conta_pagamento',
    'tipo_bancario',
    'ativo',
])]

class Associado extends Model
{
    use HasFactory;

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
