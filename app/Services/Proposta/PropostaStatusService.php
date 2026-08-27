<?php

namespace App\Services\Proposta;

use App\Enum\StatusProposta;
use App\Models\Proposta;
use Illuminate\Support\Facades\Auth;

/**
 * Classe responsavel por verificar e mudar o status da proposta
 * Os status da proposta então no diretorio Enum/StatusProposta
 */
class PropostaStatusService
{
    private function buscarStatusProposta(int $idProposta): StatusProposta
    {
        $status = Proposta::query()
            ->where('id_proposta', $idProposta)
            ->value('status_proposta');

        return StatusProposta::from($status);
    }

    private function mudarStatusProposta(int $idProposta, StatusProposta $statusProposta)
    {
        return Proposta::query()
            ->where('id_proposta', $idProposta)
            ->update(['status_proposta' => $statusProposta]);
    }

    public function podeAlterarStatus(): bool
    {
        $nivel = Auth::user()->nivel;

        return in_array($nivel, [20, 25]);
    }

    public function atualizarStatusParaEmAnalise(int $idProposta)
    {
        if (! $this->podeAlterarStatus()) {
            return;
        }

        $statusAtual = $this->buscarStatusProposta($idProposta);

        if ($statusAtual !== StatusProposta::ANDAMENTO) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::ANALISE
        );
    }

    public function atualizarStatusParaPendencia(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual === StatusProposta::RECUSADA
            || $statusAtual >= StatusProposta::ASSINADO
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::PENDENTE
        );
    }

    public function atualizarStatusParaPendenciaResolvida(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::PENDENTE
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::PENDENCIA_RESOLVIDA
        );
    }

    public function atualizarStatusParaConferida(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::ANALISE
            || $statusAtual !== StatusProposta::PENDENCIA_RESOLVIDA
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::CONFERIDO
        );
    }

    public function atualizarStatusParaAguardandoAssinatura(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::CONFERIDO
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::AGUARDANDO_ASSINATURA
        );
    }

    public function atualizarStatusParaAssinada(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::AGUARDANDO_ASSINATURA
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::ASSINADO
        );
    }

    public function atualizarStatusParaCCBEnviada(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::ASSINADO
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::CCB_ENVIADA
        );
    }

    public function atualizarStatusParaAguardandoPagamento(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::ASSINADO
            || $statusAtual !== StatusProposta::CCB_ENVIADA
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::AGUARDANDO_PAGAMENTO
        );
    }

    public function atualizarStatusParaPaga(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if (
            $statusAtual !== StatusProposta::AGUARDANDO_PAGAMENTO
        ) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::PAGO
        );
    }

    public function recusaProposta(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if ($statusAtual >= StatusProposta::AGUARDANDO_PAGAMENTO) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::RECUSADA
        );
    }
}
