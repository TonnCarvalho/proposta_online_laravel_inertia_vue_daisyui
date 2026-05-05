<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nome',
    'cpf',
    'num_proposta',
    'data_aquisicao',
    'situacao',
    'valor_nominal',
    'valor_presente',
    'data_vencimento',
    'data_upload',
    'arquivo',
])]

class Estoque extends Model
{
    //
}
