<?php

namespace App\Http\Requests;

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
            'associado.cpf' => ['required', 'string', 'max:14'],
            'associado.rg' => ['required', 'string', 'min:1', 'max:100'],
            'associado.org_exp' => ['required', 'string', 'min:1', 'max:100'],
            'associado.email' => ['required', 'string', 'min:1', 'max:100'],
            'associado.data_nasc' => ['required', 'string', 'min:1', 'max:100'],
            'associado.nat' => ['required', 'string', 'min:1', 'max:100'],
            'associado.sexo' => ['required', 'string', 'min:1', 'max:100'],
            'associado.cel' => ['required', 'string', 'min:1', 'max:100'],
            'associado.nome_pai' => ['required', 'string', 'min:1', 'max:100'],
            'associado.nome_mae' => ['required', 'string', 'min:1', 'max:100'],
            'associado.estado_civil' => ['required', 'string', 'min:1', 'max:100'],
            'associado.mat' => ['required', 'string', 'min:1', 'max:100'],
            'associado.cod_orgao' => ['required', 'string', 'min:1', 'max:100'],
            'associado.setor' => ['required', 'string', 'min:1', 'max:100'],
            'associado.cargo' => ['required', 'string', 'min:1', 'max:100'],
            'associado.ocupacao' => ['required', 'string', 'min:1', 'max:100'],
            'associado.data_admissao' => ['required', 'string', 'min:1', 'max:100'],

            'financeiro.cod_corretor' => ['required'],
            'financeiro.data_proposta' => ['required'],
            'financeiro.valor_financiado' => ['required'],
            'financeiro.valor_liberado' => ['required'],
            'financeiro.valor_parcela' => ['required'],
            'financeiro.valor_mensalidade' => ['required'],
            'financeiro.prazo' => ['required'],
            'financeiro.tipo_proposta' => ['required'],
            'financeiro.iof' => ['required'],
            'financeiro.taxa' => ['required'],
            'financeiro.fonte_pagamento' => ['required'],

            'endereco.cep' => ['required'],
            'endereco.uf' => ['required'],
            'endereco.municipio' => ['required'],
            'endereco.bairro' => ['required'],
            'endereco.endereco' => ['required'],

            'bancoContraCheque.banco' => ['required'],
            'bancoContraCheque.agencia' => ['required'],
            'bancoContraCheque.conta' => ['required'],

            'bancoRecebimento.chave_pix' => ['required'],
            'bancoRecebimento.banco_pagamento' => ['required'],
            'bancoRecebimento.agencia_pagamento' => ['required'],
            'bancoRecebimento.conta_pagamento' => ['required'],
            'bancoRecebimento.tipo_bancario' => ['required'],
        ];
    }
}
