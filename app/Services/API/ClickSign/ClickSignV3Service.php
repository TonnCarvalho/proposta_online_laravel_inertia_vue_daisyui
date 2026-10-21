<?php

namespace App\Services\API\ClickSign;

use DateTime;
use Exception;
use RuntimeException;

/**
 * Só as requisições HTTP à API, sem regra de negócio
 */
class ClickSignV3Service
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        //API URL conforme ambiente
        $this->apiUrl = config('services.clicksign.url');

        // Credencial
        $this->apiKey = config('services.clicksign.api_key');
    }

    /**
     * Criar o envelope, onde vai onde estara os dados do contrato.
     * Status inicial Draft (Rascunho)
     * Define a $data_limite (data limite) de assinatura para 30 dias
     */
    public function createEnvelope(string $nome)
    {
        $dataHoje = new DateTime();
        $dataAmanha = $dataHoje->modify('+30 day');
        $dataLimite = $dataAmanha->format('Y-m-d' . '\T' . '00:00:00.000');

        $dataEnvelope = [
            "data" => [
                "type" => "envelopes",
                "attributes" => [
                    "name" => "$nome",
                    "locale" => "pt-BR",
                    "auto_close" => true,
                    "deadline_at" => $dataLimite,
                    "remind_interval" => "3",
                    "block_after_refusal" => true,
                    "default_subject" => "SAC - Assinatura de contrato",
                    "default_message" => "",
                ]
            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($dataEnvelope),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);
        $data = $this->parseResponse($curl, 'createEnvelope');
        return $data['data']['id'];
    }

    /**
     * Atualiza o status do envelope para "Em processo".
     * "Em processo" o envelope permite a assinatura do signatario.
     * @return void
     */
    public function runningEnvelope(string $envelopeId)
    {
        $envelopeId = trim($envelopeId);

        if (empty($envelopeId)) {
            throw new RuntimeException('Envelope ID vazio ao executar runningEnvelope.');
        }

        $url = "{$this->apiUrl}/envelopes/{$envelopeId}";

        $dataEnvelope = [
            "data" => [
                "type" => "envelopes",
                "attributes" => [
                    "status" => "running",
                ],
                "id" => "$envelopeId"
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($dataEnvelope),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $data = $this->parseResponse($curl, 'runningEnvelope');

        return $data;
    }

    /**
     * Envia dados para criação do modelo de documento no Clicksign (API v3)
     * @return int documentId
     */
    public function createDocumentTemplate(string $envelopeId, array $data, string $filename, int $codLocal)
    {
        $key = $this->keyDocument($codLocal);
        $data_upload = [
            "data" => [
                "type" => "documents",
                "attributes" => [
                    "template" => [
                        "data" => $data,
                        "key" => "$key"
                    ],
                    "filename" => "$filename",
                ]
            ]
        ];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}/documents",

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_upload),
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ]
        ]);

        $response = $this->parseResponse($curl, 'createDocumentTemplate');
        return $response['data']['id'];
    }

    /**
     * Cria os assinantes do documento.
     */
    public function createSigners(string $envelopeId, string $name, string $email, string $phone_number)
    {
        $data_signers = [
            "data" => [
                "type" => "signers",
                "attributes" => [
                    "has_documentation" => false,
                    "group" => 1,
                    "location_required_enabled" => false,
                    "refusable" => true,
                    "communicate_events" => [
                        "signature_request" => "whatsapp",
                        "signature_reminder" => "email",
                        "document_signed" => "whatsapp"
                    ],
                    "name" => "$name",
                    "email" => "$email",
                    "phone_number" => "$phone_number",

                ],
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}/signers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_signers),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $data = $this->parseResponse($curl, 'createSigners');
        return $data['data']['id'];
    }

    /**
     * Informa quem é o contratado e o contratante.
     */
    public function createQualification(string $role, string $documentId, $signerId, string $envelopeId)
    {
        $data_qualify = [
            "data" => [
                "type" => "requirements",
                "attributes" => [
                    "action" => 'agree',
                    "role" => $role,
                ],
                "relationships" => [
                    "document" => [
                        "data" => [
                            "type" => "documents",
                            "id" => $documentId,
                        ],
                    ],
                    "signer" => [
                        "data" => [
                            "type" => "signers",
                            "id" => $signerId,
                        ],
                    ],
                ],
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}/requirements",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_qualify),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $data = $this->parseResponse($curl, 'createQualification');
        return $data;
    }

    /**
     * Cria o tipo de autenticação (selfie, whatsapp)
     */
    public function createAuthentication(string $documentId, $signerId, string $envelopeId, string|array $auth)
    {

        $data_authentication = [
            "data" => [
                "type" => "requirements",
                "attributes" => [
                    "action" => "provide_evidence",
                    "auth" => $auth
                ],
                "relationships" => [
                    "document" => [
                        "data" => [
                            "type" => "documents",
                            "id" => $documentId,
                        ],
                    ],
                    "signer" => [
                        "data" => [
                            "type" => "signers",
                            "id" => "$signerId"
                        ],
                    ],
                ],
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}/requirements",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_authentication),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $data = $this->parseResponse($curl, 'createAuthentication');
        return $data;
    }

    /**
     * Envia a notificação de assinatura por email.
     * @return void
     */
    public function notificationSigners(string $envelopeId): void
    {

        $data_notification = [
            "data" => [
                "type" => "notifications",
                "attributes" => [
                    "message" => null,
                ],
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}/notifications",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_notification),
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $data = $this->parseResponse($curl, 'notificationSigners');
    }

    public function deleteEnvelope(string $envelopeId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->apiUrl}/envelopes/{$envelopeId}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $this->parseResponse($curl, 'deleteEnvelope');
    }

    private function headers(): array
    {
        return [
            "Authorization: {$this->apiKey}",
            "Content-type: application/vnd.api+json",
            "accept: application/json",
        ];
    }
    private function parseResponse(\CurlHandle $curl, ?string $content = null): array
    {
        $response  = curl_exec($curl);
        $curlError = curl_error($curl);
        $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false) {
            throw new Exception("Erro cURL {$content}: {$curlError}");
        }

        $data = json_decode($response, true) ?? [];

        if ($httpCode < 200 || $httpCode >= 300) {
            $erro = $data['errors'][0]['detail'] ?? 'Erro desconhecido';
            throw new Exception("Erro Clicksign {$content} ({$httpCode}): {$erro}");
        }

        return $data;
    }

    /**
     * Define a chave do modelo que ira ser preenchido no clicksign.
     * @param string $codLocal, código local da praça.
     * @return string
     */
    private function keyDocument(string $codLocal): string
    {
        $key = null;

        //Proposta autorização | declaração Estado - Ba
        if ($codLocal == 2) {
            $key = config('services.clicksign.template.estado_ba');
        }

        //Contrato mensalidade | Declaração Municipios | Gov Paraíba
        if ($codLocal != 2) {
            $key = config('services.clicksign.template.municipios');
        }

        return $key;
    }
}
