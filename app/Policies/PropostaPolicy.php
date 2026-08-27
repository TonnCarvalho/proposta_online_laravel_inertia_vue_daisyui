<?php

namespace App\Policies;

use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class PropostaPolicy
{
    public function view(Usuario $usuario, Proposta $proposta): Response
    {
        return $this->pertenceAoCorretor($usuario, $proposta)
        || $this->administrador($usuario)
        ? Response::allow()
        : Response::deny('Acesso negado');
    }

    public function update(Usuario $usuario, Proposta $proposta): Response
    {
        return $this->pertenceAoCorretor($usuario, $proposta)
        || $this->administrador($usuario)
        ? Response::allow()
        : Response::deny('Não autorizado');
    }

    public function delete(Usuario $usuario, Proposta $proposta): Response
    {
        return $this->pertenceAoCorretor($usuario, $proposta)
        || $this->administrador($usuario)
        ? Response::allow()
        : Response::deny('Não autorizado');
    }

    public function restore(Usuario $usuario, Proposta $proposta): Response
    {
        return $this->administrador($usuario)
        ? Response::allow()
        : Response::deny('Não autorizado');
    }

    private function administrador(Usuario $usuario): bool
    {
        return $usuario->admin === 1;
    }

    private function pertenceAoCorretor(Usuario $usuario, Proposta $proposta): bool
    {
        return $usuario->cod_corretor === $proposta->cod_corretor;
    }
}
