<?php

namespace App\Enum;

enum StatusProposta: int
{
    case RECUSADA = 0;
    case ANDAMENTO = 1;
    case ANALISE = 2;
    case PENDENTE = 3;
    case PENDENCIA_RESOLVIDA = 4;
    case CONFERIDO = 5;
    case AGUARDANDO_ASSINATURA = 6;
    case ASSINADO = 7;
    case CCB_ENVIADA = 8;
    case AGUARDANDO_PAGAMENTO = 9;
    case PAGO = 10;

    public function label(): string
    {
        return match ($this) {
            self::RECUSADA => 'Recusado',
            self::ANDAMENTO => 'Em andamento',
            self::ANALISE => 'Em análise',
            self::PENDENTE => 'Pendente',
            self::PENDENCIA_RESOLVIDA => 'Pendência resolvida',
            self::CONFERIDO => 'Conferido',
            self::AGUARDANDO_ASSINATURA => 'Aguardando assinatura',
            self::ASSINADO => 'Assinado',
            self::CCB_ENVIADA => 'CCB enviada',
            self::AGUARDANDO_PAGAMENTO => 'Aguardando pagamento',
            self::PAGO => 'Pago',
        };
    }

    public static function option(): array
    {
        return collect(self::cases())
            ->map(fn ($item) => [
                'value' => $item->value,
                'label' => $item->label(),
            ])->toArray();
    }
}
