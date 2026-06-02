<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'id_usuario',
    'id_associado',
    'id_origem',
    'id_fonte_pagamento',
    'cod_corretor',
    'num_proposta',
    'valor_financiado',
    'valor_liberado',
    'valor_parcela',
    'valor_mensalidade',
    'iof',
    'taxa',
    'prazo',
    'status_proposta',
    'status_recusado',
    'status_assinatura',
    'status_refin',
    'tipo_proposta',
    'recusado_motivo',
    'tipo_assinatura',
])]
#[WithoutTimestamps]
class Proposta extends Model
{
    protected $primaryKey = 'id_proposta';
    
    public function acompanhamento(): BelongsTo
    {
        return $this->belongsTo(Acompanhamento::class, 'id_proposta');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function associado(): BelongsTo
    {
        return $this->belongsTo(Associado::class, 'id_associado');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class, 'id_origem');
    }

    public function fontePagamento(): BelongsTo
    {
        return $this->belongsTo(FontePagamento::class, 'id_fonte_pagamento');
    }

    public function pendencia(): HasOne
    {
        return $this->hasOne(Pendencia::class, 'id_pendencia');
    }

    public function refinanciamento(): HasMany
    {
        return $this->hasMany(Refinanciamento::class, 'id_proposta');
    }
}
