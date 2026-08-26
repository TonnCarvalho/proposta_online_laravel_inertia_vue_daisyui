<?php

namespace App\Http\Controllers\Web\Proposta;

use App\Enum\EstadoCivilAssociado;
use App\Enum\OcupacaoAssociado;
use App\Enum\SexoAssociado;
use App\Enum\TipoContaAssociado;
use App\Enum\TipoProposta;
use App\Http\Controllers\Controller;
use App\Models\FontePagamento;
use App\Models\Proposta;
use App\Queries\OrigemQuery;
use App\Services\Proposta\PropostaStatusService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PropostaEditController extends Controller
{
    public function __construct(
        private PropostaStatusService $propostaStatusService
    ) {}

    public function edit(Proposta $proposta, OrigemQuery $origemQuery)
    {

        $proposta = $proposta::query()
            ->select('*')
            ->where('id_proposta', $proposta->id_proposta)
            ->with('associado')
            ->get();

        $idAssociado = $proposta[0]['id_associado'];
        $idProposta = $proposta[0]['id_proposta'];

        $this->propostaStatusService->atualizarStatusParaEmAnalise($idProposta);

        $origens = $origemQuery->select(['cod_local', 'nome'])
            ->isActive()
            ->get();

        $fontePagamento = FontePagamento::select(['id', 'fonte'])
            ->get();

        $diretorio = "documentos_associado/{$idProposta}";

        // mostrar dados e imagem do documento
        $documentos = collect(
            Storage::disk('local')->files($diretorio)

        )->map(function ($arquivo) use ($idProposta) {

            $nomeArquivo = basename($arquivo);

            $extensao = strtolower(
                pathinfo($arquivo, PATHINFO_EXTENSION)
            );

            $tipo = match ($extensao) {
                'jpg', 'jpeg', 'png', 'webp' => 'imagem',
                'pdf' => 'pdf',
                default => 'arquivo'
            };

            $titulo = Str::of(
                pathinfo($nomeArquivo, PATHINFO_FILENAME)
            )->replace('_', ' ')
                ->title();

            return [
                'titulo' => $titulo,
                'url' => route('proposta.visualizar.documento', [
                    'proposta' => $idProposta,
                    'arquivo' => $nomeArquivo,
                ]),
                'download' => route('proposta.download.documento', [
                    'proposta' => $idProposta,
                    'arquivo' => $nomeArquivo,
                ]),
                'deleta' => route('proposta.deleta.documento', [
                    'proposta' => $idProposta,
                    'arquivo' => $nomeArquivo,
                ]),
                'tipo' => $tipo,
                'nome' => $nomeArquivo,
            ];
        });

        return Inertia::render('proposta/Editar', [
            'idAssociado' => $idAssociado,
            'proposta' => $proposta,
            'documentos' => $documentos,
            'origens' => $origens,
            'tipoProposta' => TipoProposta::option(),
            'sexoAssociado' => SexoAssociado::option(),
            'estadoCivilAssociado' => EstadoCivilAssociado::option(),
            'ocupacaoAssociado' => OcupacaoAssociado::option(),
            'tipoContaAssociado' => TipoContaAssociado::option(),
            'fontePagamento' => $fontePagamento,
        ]);
    }

    public function visualizarDocumento(int $idProposta, string $arquivo)
    {
        $caminho = "documentos_associado/{$idProposta}/{$arquivo}";

        if (! Storage::disk('local')->exists($caminho)) {
            abort(404);
        }

        return Storage::disk('local')->response($caminho);
    }

    public function downloadDocumento(int $idProposta, string $arquivo)
    {
        $caminho = "documentos_associado/{$idProposta}/{$arquivo}";

        if (! Storage::disk('local')->exists($caminho)) {
            abort(404);
        }

        return Storage::disk('local')->download($caminho);
    }

    public function deletaDocumento(int $idProposta, string $arquivo)
    {
        $caminho = "documentos_associado/{$idProposta}/{$arquivo}";

        if (! Storage::disk('local')->exists($caminho)) {
            abort(404);
        }

        Storage::disk('local')->delete($caminho);

        return redirect()->back()->with('flash', [
            'message' => 'Documento apagar com sucesso',
        ]);
    }
}
