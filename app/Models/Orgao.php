<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'id_origem',
    'cod_orgao',
    'nome',
    'ativo',
])]
class Orgao extends Model
{
    public function associado(): HasMany
    {
        return $this->hasMany(Associado::class, 'id_orgao');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class, 'id_origem');
    }
}
