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
        $dadosParaDocumento = $this->propostaQuery->dadosPropostaParaDocumento($idProposta);
        $dados = $this->montarDadosDocumentoClickSign->execute($dadosParaDocumento);

        //Reserva a proposta: se outra requisição já pegou, aborta.
        $reservada = Proposta::where('id_proposta', $idProposta)
            ->update(['status_assinatura' => StatusAssinatura::ENVIADO]);

        $envelopeId = null;

        try {
            //Cria envelope
            $envelopeId = $this->clicksignV3Service->createEnvelope(
                "Envelope de {$dados['nome']}"
            );

            //Cria documento
            $documentId = $this->clicksignV3Service
                ->createDocumentTemplate(
                    $envelopeId,
                    $dados,
                    $this->nomeArquivo($dados),
                    $dados['cod_local']
                );

            //Adiciona o cliente como signatario
            $this->adicionarSignatario(
                $envelopeId,
                $documentId,
                'contractor',
                [
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'phone_number'  => $dados['cel']
                ],
                ['whatsapp', 'self']
            );

            //Adicionar o contratado como signatario
            $this->adicionarSignatario(
                $envelopeId,
                $documentId,
                'contractee',
                config('services.clicksign.contratado'),
                ['whatsapp']
            );

            $this->clicksignV3Service->runningEnvelope($envelopeId);

            $this->clicksignV3Service->notificationSigners($envelopeId);
        } catch (Throwable $e) {

            if ($envelopeId) {
                rescue(
                    fn() => $this->clicksignV3Service->deleteEnvelope($envelopeId)
                );
            }

            Proposta::where('id_proposta', '=', $idProposta)
                ->update(['status_assinatura' => StatusAssinatura::PENDENTE]);

            Log::error('Falha ao enviar proposta para Clicksign', [
                'proposta_id' => $idProposta,
                'envelope_id' => $envelopeId,
                'erro' => $e->getMessage()
            ]);
        }

        Proposta::where('id_proposta', $idProposta)
        ->update([
            'status_proposta'   => StatusProposta::AGUARDANDO_ASSINATURA,
            'status_assinatura' => StatusAssinatura::AGUARDANDO_ASSINATURA        
        ]);
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
            $signatario['nome'],
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

    private function nomeArquivo(array $dados): string
    {
        return sprintf(
            '%s_%s_%s_docx',
            $dados['proposta'],
            Str::upper(Str::slug($dados['nome'], '_')),
            $dados['cpf']
        );
    }
}
