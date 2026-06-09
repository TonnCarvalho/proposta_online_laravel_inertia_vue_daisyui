<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_proposta',
    'id_usuario',
    'mensagem',
])]
#[WithoutTimestamps]
class Pendencia extends Model
{

    protected $primaryKey = 'id_pendencia';
    
    public function proposta(): BelongsTo
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

}
