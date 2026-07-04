<?php

namespace App\Enum;

enum TipoProposta: string
{
    case NOVO_MARGEM = 'novo_com_margem';
    case NOVO_MENSALIDADE = 'novo_mensalidade';
    case REFIN_MARGEM = 'refin_com_margem';
    case REFIN_MENSALIDADE = 'refin_mensalidade';
    case REFIN_2_LINHA = 'refin_2_linha';
    case SEGUNDA_LINHA = '2_linha';
    case REENQUADRAMENTO = 'reenquadramento';
    case REFINANCIAMENTO = 'refinanciamento';

    public function label(): string
    {
        return match ($this) {
            self::NOVO_MARGEM => 'Novo com margem',
            self::NOVO_MENSALIDADE => 'Novo mensalidade',
            self::REFIN_MARGEM => 'Refin com margem',
            self::REFIN_MENSALIDADE => 'Refin mensalidade',
            self::REFIN_2_LINHA => 'Refin 2ª linha',
            self::SEGUNDA_LINHA => '2ª linha',
            self::REENQUADRAMENTO => 'Reenquadramento',
            self::REFINANCIAMENTO => 'Refinanciamento',
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
