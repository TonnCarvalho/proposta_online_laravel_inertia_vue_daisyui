<?php

namespace App\Http\Controllers\Web\ClickSign;

use App\Http\Controllers\Controller;
use App\Queries\ClickSignQuery;
use App\Queries\PropostaQuery;
use App\Trait\ValorPorExtensoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class ClickSignEnviarController extends Controller
{
    public function enviarView(
        ClickSignQuery $clickSignQuery
    ) {
        $propostas = $clickSignQuery->propostasParaEnvio();

        return Inertia::render('clicksign/enviar/Enviar', [
            'propostas' => $propostas
        ]);
    }

    public function processarEnvelope(
        Request $request,
        PropostaQuery $propostaQuery
    ) {
        $propostaId     = $request->integer('propostaId');

        $dadosProposta  = $propostaQuery->dadosPropostaParaDocumento($propostaId);

        $dadosDocumento = $this->dadosAssociadoDocumento($dadosProposta->toArray());

        dd($dadosProposta->toArray(), $dadosDocumento);
    }

    private function dadosAssociadoDocumento(array $dados): array
    {
        $dataProposta = $this->converterData($dados['data_proposta']);
        
        return [
            ...$this->dadosProposta($dados),
            ...$this->dadosAssociado($dados),
            ...$this->dadosFinanceiro($dados),
            ...$this->dadosDependentes(),
            ...$this->dadosRefin($dados, $dataProposta),
            ...$this->dadosDatas($dataProposta),
            'sac' => 'Marcelo Andrade Rezende',
        ];
    }
    private function dadosProposta(array $dados): array
    {
        return [
            'id_proposta'   => $dados['id_proposta'],
            'proposta'      => $dados['num_proposta'],
            'cod_corretor'  => $dados['cod_corretor'],
            'nome_praca'    => $dados['origem']['nome'],
        ];
    }

    private function dadosAssociado(array $dados): array
    {
        return [
            'nome'          => $dados['associado']['nome'],
            'data_nasc'     => $this->formatarData($dados['associado']['data_nasc']),
            'cpf'           => $dados['associado']['cpf'],
            'rg'            => $dados['associado']['rg'],
            'mat'           => $dados['associado']['mat'],
            'estado_civil'  => $dados['associado']['estado_civil'],
            'sexo'          => $dados['associado']['sexo'] === 'M' ? 'MASCULINO' : 'FEMININO',
            'org_exp'       => $dados['associado']['orgao_exp'],
            'nome_mae'      => $dados['associado']['nome_mae'],
            'nome_pai'      => $dados['associado']['nome_pai'],
            'nat'           => $dados['associado']['nat'],
            'tel'           => $dados['associado']['tel'],
            'cel'           => $dados['associado']['cel'],
            'email'         => $dados['associado']['email'],
            'end'           => $dados['associado']['endereco'],
            'bairro'        => $dados['associado']['bairro'],
            'municipio'     => $dados['associado']['municipio'],
            'uf'            => $dados['associado']['uf'],
            'cep'           => $dados['associado']['cep'],
            'setor'         => $dados['associado']['setor'],
            'orgao'         => $dados['associado']['orgao']['nome'],
            'cargo'         => $dados['associado']['cargo'],
            'data_admissao' => $this->formatarData($dados['associado']['data_admissao']),
        ];
    }

    private function dadosFinanceiro(array $dados): array
    {
        return [
            'valor_proposta'         => $this->formatarMoeda($dados['valor_financiado']),
            'valor_proposta_extenso' => ValorPorExtensoTrait::valorPorExtenso($dados['valor_financiado']),
            'valor_liberado'         => $this->formatarMoeda($dados['valor_liberado']),
            'valor_parcela'          => $this->formatarMoeda($dados['valor_parcela']),
            'valor_parcela_extenso'  => ValorPorExtensoTrait::valorPorExtenso($dados['valor_parcela']),
            'valor_mens'             => $this->formatarMoeda($dados['valor_mensalidade']),
            'valor_mens_extenso'     => ValorPorExtensoTrait::valorPorExtenso($dados['valor_mensalidade']),
            'tipo_proposta'          => $dados['tipo_proposta'],
            'prazo'                  => $dados['prazo'],
            'banco'                  => $dados['associado']['banco'],
            'agencia'                => $dados['associado']['agencia'],
            'conta'                  => $dados['associado']['conta'],
        ];
    }
    private function dadosDependentes(): array
    {
        $dependentes = [];

        foreach ([1, 2] as $n) {
            foreach (['nome', 'nasc', 'cpf', 'parentesco', 'nome_mae'] as $campo) {
                $dependentes["dep{$n}_{$campo}"] = 'NULL';
            }
        }

        return $dependentes;
    }

    private function dadosRefin(array $dados, Carbon $data): array
    {
        $refin = [];

        foreach ([1, 2, 3] as $n) {
            // O 1º contrato usa "contrat_ant", os demais "contrat_ant2", "contrat_ant3"
            $sufixoContrato = $n === 1 ? '' : $n;

            $saldo   = $dados["saldo_devedor{$n}"] ?? null;
            $parcela = $dados["valor_parcela{$n}"] ?? null;

            $refin["contrat_ant{$sufixoContrato}"] = $dados["num_contrato{$n}"] ?? 'NULL';

            $refin["saldo{$n}"]       = filled($saldo) ? $this->formatarMoeda($saldo) : 'NULL';
            $refin["saldo{$n}_exte"]  = filled($saldo) ? ValorPorExtensoTrait::valorPorExtenso($saldo) : 'NULL';
            $refin["parce{$n}"]       = filled($parcela) ? $this->formatarMoeda($parcela) : 'NULL';
            $refin["parce{$n}_exte"]  = filled($parcela) ? ValorPorExtensoTrait::valorPorExtenso($parcela) : 'NULL';

            $refin["dia{$n}"] = filled($saldo) ? $data->format('d') : 'NULL';
            $refin["mes{$n}"] = filled($saldo) ? $this->nomeMes($data) : 'NULL';
            $refin["ano{$n}"] = filled($saldo) ? $data->format('Y') : 'NULL';
        }

        return $refin;
    }

    private function dadosDatas(Carbon $data): array
    {
        return [
            'dia4'   => $data->format('d'),
            'mes4'   => $this->nomeMes($data),
            'ano4'   => $data->format('Y'),
            'dia'    => $data->format('d'),
            'mes'    => $this->nomeMes($data),
            'ano'    => $data->format('Y'),
            'mesini' => ' ' . $data->format('m'),
            'anoini' => $data->format('Y'),
        ];
    }

    private function converterData(string $data): Carbon
    {
        // Aceita tanto "d/m/Y" quanto o formato padrão do banco "Y-m-d"
        return str_contains($data, '/')
            ? Carbon::createFromFormat('d/m/Y', $data)
            : Carbon::parse($data);
    }

    private function formatarData(?string $data): string
    {
        return filled($data) ? $this->converterData($data)->format('d/m/Y') : 'NULL';
    }

    private function formatarMoeda($valor): string
    {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }

    private function nomeMes(Carbon $data): string
    {
        return ucfirst($data->locale('pt_BR')->translatedFormat('F'));
    }
}
