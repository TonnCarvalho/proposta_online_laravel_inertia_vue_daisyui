<?php

namespace App\Models;

use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_proposta',
    'id_usuario',
    'id_conferente',
    'status_proposta',
])]
#[WithoutTimestamps]
class Acompanhamento extends Model
{
    protected $primaryKey = 'id_conferencia';

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function proposta(): BelongsTo
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }
    
}
