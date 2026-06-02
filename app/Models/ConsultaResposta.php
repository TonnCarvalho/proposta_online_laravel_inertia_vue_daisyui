<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_usuario',
    'id_consulta',
    'resposta1',
    'resposta2',
    'resposta3',
    'resposta4',
    'resposta5',
    'resposta6',
    'resposta7',
    'resposta8',
    'resposta9',
    'resposta10',
])]
class ConsultaResposta extends Model
{
    protected $primaryKey = 'id_consulta';
    
    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    public function consulta():BelongsTo
    {
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }
}
