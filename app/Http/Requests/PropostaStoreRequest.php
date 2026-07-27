<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropostaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'associado.nome' => ['required', 'string', 'max:100'],
            'associado.cod_local' => ['required', 'integer'],
            'associado.cpf' => ['required', 'string', 'min:14', 'max:20'],
            'associado.rg' => ['required', 'string', 'min:14', 'max:15'],
            'associado.org_exp' => ['required', 'string', 'min:2', 'max:10'],
            'associado.email' => ['required', 'email:rfc,dns', 'min:7', 'max:50'],
            'associado.data_nasc' => ['required', 'string'],
            'associado.nat' => ['required', 'string', 'min:3', 'max:50'],
            'associado.sexo' => ['required', 'string', 'min:1', 'max:10'],
            'associado.cel' => ['required', 'string', 'min:11', 'max:20'],
            'associado.nome_pai' => ['nullable', 'string', 'max:100'],
            'associado.nome_mae' => ['required', 'string', 'min:10', 'max:100'],
            'associado.estado_civil' => ['required', 'string', 'min:1', 'max:20'],
            'associado.mat' => ['required', 'string', 'min:1', 'max:50'],
            'associado.cod_orgao' => ['required', 'integer'],
            'associado.setor' => ['required', 'string', 'min:1', 'max:50'],
            'associado.cargo' => ['required', 'string', 'min:1', 'max:50'],
            'associado.ocupacao' => ['required', 'string', 'min:1', 'max:15'],
            'associado.data_admissao' => ['required', 'string'],

            'financeiro.cod_corretor' => ['required', 'integer'],
            'financeiro.data_proposta' => ['required', 'string'],
            'financeiro.valor_financiado' => ['required', 'numeric', 'decimal:2', 'min:0.01'],
            'financeiro.valor_liberado' => ['nullable', 'decimal:2', 'min:0.01'],
            'financeiro.valor_parcela' => ['required', 'decimal:2', 'min:0.01'],
            'financeiro.valor_mensalidade' => ['required', 'decimal:2', 'min:0.01'],
            'financeiro.prazo' => ['required', 'integer'],
            'financeiro.tipo_proposta' => ['nullable', 'string', 'max:50'],
            'financeiro.iof' => ['required', 'decimal:2', 'min:0.01'],
            'financeiro.taxa' => ['required', 'numeric:strict'],
            'financeiro.fonte_pagamento' => ['nullable', 'integer'],

            'endereco.cep' => ['required', 'string', 'min:1', 'max:10'],
            'endereco.uf' => ['required', 'string', 'max:2'],
            'endereco.municipio' => ['required', 'string', 'max:50'],
            'endereco.bairro' => ['required', 'string', 'max:50'],
            'endereco.endereco' => ['required', 'string', 'max:100'],

            'bancoContraCheque.banco' => ['required', 'string', 'max:10'],
            'bancoContraCheque.agencia' => ['required', 'string', 'max:10'],
            'bancoContraCheque.conta' => ['required', 'string', 'max:25'],

            'bancoRecebimento.chave_pix' => ['nullable', 'string', 'max:255'],
            'bancoRecebimento.banco_pagamento' => ['required', 'string', 'max:10'],
            'bancoRecebimento.agencia_pagamento' => ['required', 'string', 'max:25'],
            'bancoRecebimento.conta_pagamento' => ['required', 'string', 'max:10'],
            'bancoRecebimento.tipo_bancario' => ['nullable', 'string', 'max:10'],
        ];
    }
    public function attributes(): array
    {
        return [
            'associado.nome' => 'nome',
            'associado.cod_local' => 'praça',
            'associado.cpf' => 'cpf',
            'associado.rg' => 'rg',
            'associado.org_exp' => 'órgão expedidor',
            'associado.email' => 'email',
            'associado.data_nasc' => 'data de nascimento',
            'associado.nat' => 'naturalidade',
            'associado.sexo' => 'sexo',
            'associado.cel' => 'celular',
            'associado.nome_pai' => 'nome do pai',
            'associado.nome_mae' => 'nome da mãe',
            'associado.estado_civil' => 'estado civil',
            'associado.mat' => 'matricula',
            'associado.cod_orgao' => 'órgão',
            'associado.setor' => 'setor',
            'associado.cargo' => 'cargo',
            'associado.ocupacao' => 'ocupacao',
            'associado.data_admissao' => 'data de admissão',

            'financeiro.cod_corretor' => 'código do corretor',
            'financeiro.data_proposta' => 'data da proposta',
            'financeiro.valor_financiado' =>  'valor financiado',
            'financeiro.valor_liberado' => 'valor liberado',
            'financeiro.valor_parcela' => 'valor da parcela',
            'financeiro.valor_mensalidade' => 'valor da mensalidade',
            'financeiro.prazo' => 'prazo',
            'financeiro.tipo_proposta' => 'tipo de proposta',
            'financeiro.iof' => 'iof',
            'financeiro.taxa' => 'taxa',
            'financeiro.fonte_pagamento' => 'fonte pagamento',

            'endereco.cep' => 'cep',
            'endereco.uf' => 'estado',
            'endereco.municipio' => 'município',
            'endereco.bairro' => 'bairro',
            'endereco.endereco' => 'endereço',

            'bancoContraCheque.banco' => 'banco',
            'bancoContraCheque.agencia' => 'agencia',
            'bancoContraCheque.conta' => 'conta',

            'bancoRecebimento.chave_pix' => 'chave do pix',
            'bancoRecebimento.banco_pagamento' => 'banco',
            'bancoRecebimento.agencia_pagamento' => 'agencia',
            'bancoRecebimento.conta_pagamento' => 'conta',
            'bancoRecebimento.tipo_bancario' => 'tipo da bancario',
        ];
    }
    public function prepareForValidation()
    {
        $associado = $this->input('associado', []);
        $associado['data_nasc'] = $this->converterDataParTipoDate($associado['data_nasc'] ?? null);

        $associado['data_admissao'] = $this->converterDataParTipoDate($associado['data_admissao'] ?? null);

        $financeiro = $this->input('financeiro', []);

        $financeiro['valor_financiado'] = $this->converterMoedaParaDecimal($financeiro['valor_financiado'] ?? null);

        $financeiro['valor_liberado'] = $this->converterMoedaParaDecimal($financeiro['valor_liberado'] ?? null);

        $financeiro['valor_parcela'] = $this->converterMoedaParaDecimal($financeiro['valor_parcela'] ?? null);

        $financeiro['valor_mensalidade'] = $this->converterMoedaParaDecimal($financeiro['valor_mensalidade'] ?? null);

        $financeiro['iof'] = $this->converterMoedaParaDecimal($financeiro['iof'] ?? null);

        $financeiro['data_proposta'] = $this->converterDataParaTimeStamp($financeiro['data_proposta'] ?? null);

        $this->merge([
            'associado' => $associado,
            'financeiro' => $financeiro,
        ]);
    }

    /**
     * converte o formato da moeda de '1.000,00' para '1000.00'
     *
     * @param string|null $valor
     * @return string|null
     */
    private function converterMoedaParaDecimal(?string $valor): ?string
    {
        if ($valor === null || trim($valor) === '') {
            return $valor;
        }

        // Remove o ponto usada como separador de milhar
        $valor = str_replace('.', '', $valor);

        //Trocar a vírgula decimal por ponto
        $valor = str_replace(',', '.', $valor);

        return $valor;
    }

    /**
     * Converte a data (dd/mm/aaaa) para o formato timestamp (yyyy-mm-dd H:i:s)
     *
     * @param string|null $data
     * @return string
     */
    private function converterDataParaTimeStamp(?string $data): ?string
    {

        if ($data === null || trim($data) === '') {
            return $data;
        }

        return $data = Carbon::createFromFormat('d/m/Y', $data)
            ->format('Y-m-d H:i:s');
    }

    /**
     * Converte a data (dd/mm/aaaa) para formato date ('yyyy-mm-dd)
     * @param string|null $data
     * @return string
     */
    private function converterDataParTipoDate(?string $data): ?string
    {
        if ($data === null || trim($data) === '') {
            return $data;
        }

        return $data = Carbon::createFromFormat('d/m/Y', $data)
            ->format('Y-m-d');
    }
}
