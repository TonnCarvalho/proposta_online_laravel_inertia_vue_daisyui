<?php

namespace App\Services\Proposta;

use App\Enum\StatusProposta as StatusProposta;
use App\Models\Proposta;

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

    public function statusEmAnalise(int $idProposta)
    {
        $statusAtual = $this->buscarStatusProposta($idProposta);

        if ($statusAtual !== StatusProposta::ANDAMENTO) {
            return;
        }

        return $this->mudarStatusProposta(
            $idProposta,
            StatusProposta::ANALISE
        );
    }

    public function statusPendencia(int $idProposta)
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

    public function pendenciaResolvida(int $idProposta)
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

    public function propostaConferida(int $idProposta)
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

    public function propostaAguardandoAssinatura(int $idProposta)
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

    public function propostaAssinada(int $idProposta)
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

    public function statusCCBEnviada(int $idProposta)
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

    public function propostaAguardandoPagamento(int $idProposta)
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

    public function propostaPaga(int $idProposta)
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