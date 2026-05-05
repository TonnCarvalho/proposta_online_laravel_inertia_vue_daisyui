<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_usuario',
    'id_proposta',
    'id_associado',
    'num_proposta1',
    'saldo_devedor1',
    'valor_parcela1',
    'num_proposta2',
    'saldo_devedor2',
    'valor_parcela2',
    'num_proposta3',
    'saldo_devedor3',
    'valor_parcela3',
])]
class Refinanciamento extends Model
{
    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }    
    public function proposta():BelongsTo
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }
    public function associado():BelongsTo
    {
        return $this->belongsTo(Associado::class, 'id_associado');
    }

}
