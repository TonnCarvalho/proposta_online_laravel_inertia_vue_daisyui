<?php

namespace App\Models;

use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_usuario',
    'id_proposta',
    'status_proposta',
])]
class Acompanhamento extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function proposta(): BelongsTo
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }
    
}
