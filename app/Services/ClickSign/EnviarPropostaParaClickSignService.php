<?php

namespace App\Services\ClickSign;

use App\Action\Proposta\MontarDadosDocumentoClickSign;
use App\Enum\StatusAssinatura;
use App\Enum\StatusProposta;
use App\Models\Proposta;
use App\Queries\PropostaQuery;
use App\Services\API\ClickSign\ClickSignV3Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

/**
 * Orquestra o fluxo: valida status, reserva a proposta, cria envelope, adiciona signatários, trata erro, atualiza status
 */
class EnviarPropostaParaClickSignService
{

    public function __construct(
        private ClickSignV3Service $clicksignV3Service,
        private MontarDadosDocumentoClickSign $montarDadosDocumentoClickSign,
        private PropostaQuery $propostaQuery,
    ) {}

    public function executar(int $idProposta): void
    {
        // 1. Reserva: só uma requisição consegue fazer essa troca
        $reservada = Proposta::query()
            ->where('id_proposta', $idProposta)
            ->where('status_proposta', StatusProposta::CONFERIDO->value)
            ->where('status_assinatura', StatusAssinatura::NAO_ENVIADO->value)
            ->update(['status_assinatura' => StatusAssinatura::AGUARDANDO_ASSINATURA->value]);

        if (! $reservada) {
            throw new RuntimeException('Proposta já enviada ou com status inválido para envio.');
        }

        $envelopeId = null;
        $documentId = null;

        // 2. Montagem do envelope (ainda em rascunho, dá para desfazer)
        try {
            $proposta = $this->propostaQuery->dadosPropostaParaDocumento($idProposta);
            $dadosAssociado = $this->montarDadosDocumentoClickSign->execute($proposta);

            //Cria envelope
            $envelopeId = $this->clicksignV3Service->createEnvelope(
                "Envelope de {$dadosAssociado['nome']}"
            );

            //Cria documento
            $documentId = $this->clicksignV3Service
                ->createDocumentTemplate(
                    $envelopeId,
                    $dadosAssociado,
                    $this->nomeArquivo($dadosAssociado),
                    $dadosAssociado['cod_local']
                );

            // Cliente (contratante)
            $this->adicionarSignatario(
                $envelopeId,
                $documentId,
                'contractor',
                [
                    'name'          => $dadosAssociado['nome'],
                    'email'         => $dadosAssociado['email'],
                    'phone_number'  => $dadosAssociado['cel']
                ],
                ['whatsapp']
                // ['whatsapp', 'selfie']
            );

            // Contratado

            $this->adicionarSignatario(
                $envelopeId,
                $documentId,
                'contractee',
                config('services.clicksign.contratado'),
                ['whatsapp']
            );

            $this->clicksignV3Service->runningEnvelope($envelopeId);
        } catch (Throwable $e) {
            $this->desfazerEnvio($idProposta, $envelopeId, $e);

            throw $e;
        }

        // 3. Ponto sem volta: o envelope já está ativo
        Proposta::query()
            ->where('id_proposta', $idProposta)
            ->update([
                'status_proposta' => StatusProposta::AGUARDANDO_ASSINATURA->value
            ]);

        // 4. Notificação: se falhar, só registra (dá para reenviar depois)
        try {
            $this->clicksignV3Service->notificationSigners($envelopeId);
        } catch (Throwable $e) {
            Log::warning('Envelope ativo, mas falhou ao notificar signatários', [
                'proposta_id' => $idProposta,
                'envelope_id' => $envelopeId,
                'exception'   => $e,
            ]);
        }
    }

    /**
     * Cria o Signatario, depois cria a qualificação e o tipo de autenticação.
     */
    private function adicionarSignatario(
        string $envelopeId,
        string $documentId,
        string $qualificacao,
        array $signatario,
        array $autenticacoes,
    ): void {

        //Cria o Signatario
        $signerId = $this->clicksignV3Service->createSigners(
            $envelopeId,
            $signatario['name'],
            $signatario['email'],
            $signatario['phone_number']
        );

        //Adiciona a qualificacao
        $this->clicksignV3Service->createQualification(
            $qualificacao,
            $documentId,
            $signerId,
            $envelopeId
        );

        //Cria o tipo de autenticação
        foreach ($autenticacoes as $auth) {
            $this->clicksignV3Service->createAuthentication(
                $documentId,
                $signerId,
                $envelopeId,
                $auth
            );
        }
    }

    private function desfazerEnvio(int $idProposta, ?string $envelopeId, Throwable $e): void
    {
        if ($envelopeId) {
            rescue(fn() => $this->clicksignV3Service->deleteEnvelope($envelopeId));
        }

        Proposta::query()
            ->where('id_proposta', $idProposta)
            ->update(['status_assinatura' => StatusAssinatura::NAO_ENVIADO->value]);

        Log::error('Falha ao enviar proposta para Clicksign', [
            'proposta_id' => $idProposta,
            'envelope_id' => $envelopeId,
            'exception'   => $e,
        ]);
    }

    private function nomeArquivo(array $dadosAssociado): string
    {
        return sprintf(
            '%s_%s_%s.docx',
            $dadosAssociado['proposta'],
            Str::upper(Str::slug($dadosAssociado['nome'], ' ')),
            $dadosAssociado['cpf']
        );
    }
}
