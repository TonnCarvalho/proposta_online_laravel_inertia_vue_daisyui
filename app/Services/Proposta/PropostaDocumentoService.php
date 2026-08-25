<?php

namespace App\Services\Proposta;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PropostaDocumentoService
{
    private const NOMES_DOCUMENTOS  = [
        'frenteDocumento' => 'documento_frente',
        'versoDocumento' => 'documento_verso',
        'contraCheque' => 'contra_cheque',
        'comprovanteBancario' => 'comprovante_bancario',
        'comprovanteResidencia' => 'comprovante_residencia',
        'consultaReceitaFederal' => 'consulta_receita_federal',
        'averbacaoBeneficio' => 'averbacao_beneficio',
        'averbacaoMensalidade' => 'averbacao_mensalidade',
        'outrosDocumentos' => 'outros',
    ];

    private const EXTENSOES = [
        'jpg',
        'jpeg',
        'png',
        'pdf',
    ];

    public function salvarDocumentos(int $idProposta, array $documentos): void
    {
        foreach (self::NOMES_DOCUMENTOS  as $campo => $nomeDocumento) {
            $arquivo = $documentos[$campo] ?? null;

            if (!$arquivo instanceof UploadedFile) {
                continue;
            }

            $this->salvarDocumento(
                $arquivo,
                $idProposta,
                $nomeDocumento
            );
        }
    }

    private function salvarDocumento(
        UploadedFile $arquivo,
        int $idProposta,
        string $nomeDocumento
    ): void {
    
        $diretorio = "/documentos_associado/{$idProposta}/";

        $extensao = $arquivo->extension();

        $this->excluirDocumentoExistente(
            $diretorio,
            $nomeDocumento
        );

        //Salvar o arquivo no diretorio.
        $arquivo->storeAs(
            $diretorio,
            "{$nomeDocumento}.{$extensao}",
            'local'
        );

    }

    private function excluirDocumentoExistente(
        string $diretorio,
        string $nomeDocumento
    ): void {
        foreach (self::EXTENSOES as $extensao) {
            $caminhoArquivo = "{$diretorio}/{$nomeDocumento}.{$extensao}";

            if (!Storage::disk('local')->exists($caminhoArquivo)) {
                continue;
            }

            Storage::disk('local')->delete($caminhoArquivo);
        }
    }
}
