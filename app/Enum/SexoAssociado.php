<?php

namespace App\Enum;

enum SexoAssociado: string
{
    case MASCULINO = 'M';
    case FEMININO = 'F';

    public function label(): string
    {
        return match ($this) {
            self::MASCULINO => 'Masculino',
            self::FEMININO => 'Feminino',
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
