<?php

namespace App\Services\Proposta;

use App\Action\Acompanhamento\CriarAcompanhamento;
use App\Action\Proposta\MontarDadosAssociado;
use App\Action\Proposta\MontarDadosProposta;
use App\Models\Associado;
use App\Models\Proposta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PropostaStoreService
{
    public function __construct(
        private CriarAcompanhamento $criarAcompanhamento,
        private MontarDadosAssociado $montarDadosAssociado,
        private MontarDadosProposta $montarDadosProposta,
    ) {}

    public function criarProposta(string $tipoCadastro, array $dados): array
    {
        return DB::transaction(function () use ($tipoCadastro, $dados) {
            return match ($tipoCadastro) {
                'novo_associado' => $this->cadastrarNovoAssociado($dados),

                'nova_matricula' => $this->cadastrarNovaMatricula($dados),

                'matricula_existente' => $this->cadastrarComMatriulaExistente($dados),

                default => throw ValidationException::withMessages([
                    'tipo' => 'Tipo de cadastrdo inválido',
                ]),
            };
        });
    }

    private function cadastrarNovoAssociado(array $dados): array
    {
        //cadastra associado.
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::create($dadosAssociado);

        //cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        //adicionado ao acompanhamento
        $this->criarAcompanhamento->execute(
            $proposta->id_proposta,
            'em andamento'
        );

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
    private function cadastrarNovaMatricula(array $dados)
    {
        //cadastra associado.
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::create($dadosAssociado);

        //cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        //adicionado ao acompanhamento
        $this->criarAcompanhamento->execute(
            $proposta->id_proposta,
            'em andamento'
        );

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
    private function cadastrarComMatriulaExistente(array $dados): array
    {
        //atualizar associado.
        $dadosAssociado = $this->montarDadosAssociado->execute($dados);

        $associado = Associado::findOrFail($dadosAssociado['id_associado']);
        $associado->update($dadosAssociado);

        //cadastrar proposta.
        $dadosProposta = $this->montarDadosProposta->execute($dados);

        $dadosProposta['id_associado'] = $associado->id_associado;
        $dadosProposta['num_proposta'] = Proposta::max('num_proposta') + 1;

        $proposta = Proposta::create($dadosProposta);

        //adicionado ao acompanhamento
        $this->criarAcompanhamento->execute(
            $proposta->id_proposta,
            'em andamento'
        );

        return [
            'associado' => $associado,
            'proposta' => $proposta
        ];
    }
}
