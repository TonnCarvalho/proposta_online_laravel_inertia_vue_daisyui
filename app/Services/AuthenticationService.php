<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
/**
 * Verifica se a senha está em MD5 para atualizar para Hash.
 * Realiza o login.
 * @param string $cod_corretor
 * @param string $password
 * @return bool
 */
    public function authenticate(string $cod_corretor, string $password): bool
    {
        $user = Usuario::where('cod_corretor', $cod_corretor)->first();

        if (! $user) {
            return false;
        }
        
        // Caso 1: senha em MD5 + atualação para Hash
        if ($this->isMd5Hash($user->password)) {
            if ($user->password !== md5($password)) {
                return false;
            }

            $user->password = Hash::make($password);
            $user->save();

            Auth::login($user);

            return true;
        }

        // Caso 2: senha já é Hash
        if (! Hash::check($password, $user->password)) {
            return false;
        }

        Auth::login($user);

        return true;

    }

    private function isMd5Hash(string $hash): bool
    {
        return preg_match('/^[a-f0-9]{32}$/i', $hash) === 1;
    }
}
