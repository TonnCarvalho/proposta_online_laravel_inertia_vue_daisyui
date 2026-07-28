<?php

namespace App\Enum;

enum OcupacaoAssociado: string
{
    case ATIVO = 'ATIVO';
    case APOSENTADO = 'APOSENTADO';
    case PENSIONISTA = 'PENSIONISTA';

    public function label(): string
    {
        return match ($this) {
            self::ATIVO => 'Ativo (a)',
            self::APOSENTADO => 'Aposentado (a)',
            self::PENSIONISTA => 'Pensionista (a)',
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