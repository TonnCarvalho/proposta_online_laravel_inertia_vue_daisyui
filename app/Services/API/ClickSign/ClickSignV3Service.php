<?php

namespace App\Services\API\ClickSign;

use DateTime;
use Exception;
use RuntimeException;

class ClickSignV3Service
{
    private string $appEnv;
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        // Ambiente (local | produção)
        $this->appEnv = $_ENV['APP_ENV'] ?? 'local';

        //API URL conforme ambiente
        $this->apiUrl = $this->appEnv === 'production'
            ? 'https://app.clicksign.com/api/v3'
            : 'https://sandbox.clicksign.com/api/v3';

        // Credencial
        $this->apiKey = $_ENV['CLICKSIGN_API_KEY'];
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
        ]);

        try {
            $data = $this->parseResponse($curl, 'createEnvelope');
            return $data['data']['id'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
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

        try {
            $data = $this->parseResponse($curl, 'createDocumentTemplate');
            return $data['data']['id'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cria os assinantes do documento.
     * @return signerId
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
                        "signature_request" => "whatsapp", //whatsapp, email
                        "signature_reminder" => "email",
                        "document_signed" => "whatsapp" //whatsapp, email
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
        ]);

        try {
            $data = $this->parseResponse($curl, 'createSigners');
            return $data['data']['id'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Informa quem é o contratado e o contratante.
     */
    public function createQualification(string $role, string $documentId, string $signersId, string $envelopeId)
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
                            "id" => $signersId,
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
        ]);
        try {
            $data = $this->parseResponse($curl, 'createQualification');
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cria o tipo de autenticação (selfie, whatsapp)
     */
    public function createAuthentication(string $documentId, string $signersId, string $envelopeId, string|array $auth)
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
                            "id" => "$signersId"
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
        ]);

        try {
            $data = $this->parseResponse($curl, 'createAuthentication');
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->apiKey",
                "Content-type: application/vnd.api+json",
                "accept: application/json"
            ],
        ]);

        curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }
    }

    private function parseResponse(object $curl, null|string $content = null): array|string
    {
        $response = curl_exec($curl);
        $curlError = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            throw new Exception("Error cURL {$content}: " . $curlError);
        }

        curl_close($curl);

        $data = json_decode($response, true);

        if ($httpCode < 200 || $httpCode >= 300) {
            $erro = $data['errors'][0]['detail'] ?? 'Error desconhecido';
            throw new Exception("Error Clicksign {$content} ({$httpCode}): {$erro}");
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
        $key = '';

        if ($this->appEnv == 'local') {
            return $key = 'f464b143-4f07-4c44-80f1-64790cafd5cd';
        }

        //Proposta autorização | declaração Estado - Ba
        if ($codLocal == 2) {
            $key = '6a908a20-8adb-4a8a-8065-eaffb855da6f';
        }

        //Contrato mensalidade | Declaração Municipios | Gov Paraíba
        if ($codLocal != 2) {
            $key = 'fc25b47f-2ce3-418f-89e3-9cdf55eab3da';
        }

        return $key;
    }
}
