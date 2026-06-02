<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'fonte',
    'saldo',
    'inativo',
])]
class FontePagamento extends Model
{
    public function proposta(): HasMany
    {
        return $this->hasMany(Proposta::class, 'id_fonte_pagamento');
    }
    
}
