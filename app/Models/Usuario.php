<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'cod_coretor',
    'nome',
    'email',
    'password',
    'cpf',
    'ddd_tel',
    'tel',
    'ddd_cel',
    'cel',
    'uf',
    'localidade',
    'ativo',
    'atualizado',
])]
#[Hidden(['remember_token'])]

class Usuario extends Authenticatable
{
    /** @use HasFactory<UsuarioFactory> */
    use HasFactory, Notifiable;

    public function acompanhamento(): HasMany
    {
        return $this->hasMany(Acompanhamento::class, 'id_usuario');
    }

    public function associado(): HasMany
    {
        return $this->hasMany(Associado::class, 'id_usuario');
    }

    public function consulta(): HasMany
    {
        return $this->hasMany(Consulta::class, 'id_usuario');
    }

    public function consultaResposta(): HasMany
    {
        return $this->hasMany(ConsultaResposta::class, 'id_usuario');
    }

    public function pendencia(): HasMany
    {
        return $this->hasMany(Pendencia::class, 'id_usuario');
    }

    public function proposta(): HasMany
    {
        return $this->hasMany(Proposta::class, 'id_proposta');
    }

    public function refinanciamento(): HasMany
    {
        return $this->hasMany(Refinanciamento::class, 'id_usuario');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
