<?php

namespace App\Trait;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

/**
 * Se a Policy não autorizar, redireciona o usuário para uma rota.
 */
trait AutorizacaoComRedirecionamento
{
    public function handleDenied(
        string $ability,
        mixed $arguments,
        string $route,
        string $subMessage = '',
        string $type = ''): ?RedirectResponse
    {
        $autorizacao = Gate::inspect($ability, $arguments);

        if ($autorizacao->allowed()) {
            return null;
        }

        return redirect()
            ->route($route)
            ->with(['alert' => [
                'message' => $autorizacao->message(),
                'subMessage' => $subMessage,
                'type' => $type,
            ]]);

    }
}
