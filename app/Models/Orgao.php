<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'cod_local',
    'cod_orgao',
    'nome',
    'inativo',
])]
#[WithoutTimestamps]
class Orgao extends Model
{
    protected $primaryKey = 'id_orgao';
    
    public function associado(): HasMany
    {
        return $this->hasMany(Associado::class, 'id_orgao');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class, 'id_origem');
    }
}
