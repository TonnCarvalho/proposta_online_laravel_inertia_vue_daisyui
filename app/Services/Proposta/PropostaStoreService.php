<?php

namespace App\Services\Proposta;

use App\Action\Acompanhamento\CriarAcompanhamentoAction;
use App\Action\Proposta\MontarDadosAssociado;
use App\Action\Proposta\MontarDadosProposta;
use App\Models\Associado;
use App\Models\Proposta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PropostaStoreService
{
    public function __construct(
        private CriarAcompanhamentoAction $criarAcompanhamentoAction,
        private MontarDadosAssociado $montarDadosAssociado,
        private MontarDadosProposta $montarDadosProposta,
        private PropostaDocumentoService $propostaDocumentoService,
    ) {}

    public function criarProposta(string $tipoCadastro, array $dados): array
    {
        return DB::transaction(function () use ($tipoCadastro, $dados) {
            return match ($tipoCadastro) {

                'nova_matricula',
                'novo_associado' => $this->cadastrarNovaMatriculaOuNovoAssociado($dados),

                'matricula_existente' => $this->cadastrarComMatriulaExistente($dados),

                default => throw ValidationException::withMessages([
                    'tipo' => 'Tipo de cadastrdo inválido',
                ]),
            };
        });
    }

    private function cadastrarNovaMatriculaOuNovoAssociado(array $dados)
    {
        // cadastra associado.
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::create($dadosAssociado);

        // cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        // adiciona os documentos
        $this->propostaDocumentoService->salvarDocumentos(
            $proposta->id_proposta,
            $dados['documento']
        );
        // adicionado ao acompanhamento
        $this->criarAcompanhamentoAction->execute(
            $proposta->id_proposta,
        );

        return [
            'associado' => $associado,
            'proposta' => $proposta,
        ];
    }

    private function cadastrarComMatriulaExistente(array $dados): array
    {
        // atualizar associado.
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::findOrFail($dadosAssociado['id_associado']);
        $associado->update($dadosAssociado);

        // cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        // adicionado ao acompanhamento
        $this->criarAcompanhamentoAction->execute(
            $proposta->id_proposta,
        );

        return [
            'associado' => $associado,
            'proposta' => $proposta,
        ];
    }
}
