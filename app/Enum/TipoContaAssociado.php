<?php

namespace App\Enum;

enum TipoContaAssociado: string
{
    case CORRENTE = 'C';
    case POUPANCA = 'P';

    public function label(): string
    {
        return match ($this) {
            self::CORRENTE => 'Corrente',
            self::POUPANCA => 'Poupança',
        };
    }
    public static function option(): array
    {
        return collect(self::cases())
            ->map(fn($item) => [
                'value' => $item->value,
                'label' => $item->label(),
            ])->toArray();
    }
}
