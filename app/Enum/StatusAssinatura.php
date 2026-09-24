<?php

namespace App\Enum;

enum StatusAssinatura: int
{
    case NAO_ENVIADO = 1;
    case AGUARDANDO_ASSINATURA = 2;
    case ASSINADO = 3;

    public function label(): string
    {
        return match ($this) {
            self::NAO_ENVIADO => 'Não enviado',
            self::AGUARDANDO_ASSINATURA => 'Aguardando assinatura',
            self::ASSINADO => 'Assinado'
        };
    }
}
