<?php

namespace App\Enum;

enum EstadoCivilAssociado: string
{
    case SOLTEIRO = 'SOLTEIRO';
    case CASADO = 'CASADO';
    case DIVORCIADO = 'DIVORCIADO';
    case VIUVO = 'VIUVO';

    public function label(): string
    {
        return match ($this) {
            self::SOLTEIRO => 'Solteiro (a)',
            self::CASADO => 'Casado (a)',
            self::DIVORCIADO => 'Divorciado (a)',
            self::VIUVO => 'Viuvo (a)'
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
