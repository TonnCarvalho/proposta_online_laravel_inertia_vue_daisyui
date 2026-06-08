<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'id_usuario',
    'email',
    'praca',
    'status_consulta',
    'nome1',
    'cpf1',
    'matricula1',
    'data_nascimento1',
    'nome2',
    'cpf2',
    'matricula2',
    'data_nascimento2',
    'nome3',
    'cpf3',
    'matricula3',
    'data_nascimento3',
    'nome4',
    'cpf4',
    'matricula4',
    'data_nascimento4',
    'nome5',
    'cpf5',
    'matricula5',
    'data_nascimento5',
    'nome6',
    'cpf6',
    'matricula6',
    'data_nascimento6',
    'nome7',
    'cpf7',
    'matricula7',
    'data_nascimento7',
    'nome8',
    'cpf8',
    'matricula8',
    'data_nascimento8',
    'nome9',
    'cpf9',
    'matricula9',
    'data_nascimento9',
    'nome10',
    'cpf10',
    'matricula10',
    'data_nascimento10',
])]
#[WithoutTimestamps]
class Consulta extends Model
{
    protected $primaryKey = 'id_consulta';

    public function consultaResposta(): HasOne
    {
        return $this->hasOne(ConsultaResposta::class, 'id_consulta');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class, 'cod_local');
    }
}
