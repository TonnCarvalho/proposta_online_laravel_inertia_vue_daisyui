<?php

namespace App\Action\Proposta;

use App\Models\Proposta;
use App\Trait\ValorPorExtensoTrait;
use Illuminate\Support\Carbon;

/**
 * Monta os dados que seram usados para montar o template do Click Sign.
 */
class MontarDadosDocumentoClickSign
{

    public function execute(Proposta $proposta): array
    {
        $dados = $proposta->toArray();

        $dataProposta = $this->converterData($dados['data_proposta']);

        return [
            ...$this->dadosProposta($dados),
            ...$this->dadosAssociado($dados['associado']),
            ...$this->dadosFinanceiro($dados),
            ...$this->dadosDependentes(),
            ...$this->dadosRefin($dados['refinanciamento'] ?? [], $dataProposta),
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

    private function dadosAssociado(array $associado): array
    {
        return [
            'nome'          => $associado['nome'],
            'data_nasc'     => $this->formatarData($associado['data_nasc']),
            'cpf'           => $associado['cpf'],
            'rg'            => $associado['rg'],
            'mat'           => $associado['mat'],
            'estado_civil'  => $associado['estado_civil'],
            'sexo'          => $associado['sexo'] === 'M' ? 'MASCULINO' : 'FEMININO',
            'org_exp'       => $associado['orgao_exp'],
            'nome_mae'      => $associado['nome_mae'],
            'nome_pai'      => $associado['nome_pai'],
            'nat'           => $associado['nat'],
            'tel'           => $associado['tel'],
            'cel'           => $associado['cel'],
            'email'         => $associado['email'],
            'end'           => $associado['endereco'],
            'bairro'        => $associado['bairro'],
            'municipio'     => $associado['municipio'],
            'uf'            => $associado['uf'],
            'cep'           => $associado['cep'],
            'setor'         => $associado['setor'],
            'orgao'         => $associado['orgao']['nome'],
            'cargo'         => $associado['cargo'],
            'data_admissao' => $this->formatarData($associado['data_admissao']),
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
