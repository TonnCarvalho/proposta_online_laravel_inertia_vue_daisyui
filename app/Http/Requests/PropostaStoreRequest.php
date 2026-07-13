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
            // 'associado.nome' => ['required', 'string', 'max:100'],
            // 'associado.cod_local' => ['required', 'integer'],
            // 'associado.cpf' => ['required', 'string','min:14', 'max:20'],
            // 'associado.rg' => ['required', 'string', 'min:14', 'max:15'],
            // 'associado.org_exp' => ['required', 'string', 'min:2', 'max:10'],
            // 'associado.email' => ['required', 'email:rfc,dns', 'min:7', 'max:50'],
            // 'associado.data_nasc' => ['required', 'string'],
            // 'associado.nat' => ['required', 'string', 'min:3', 'max:50'],
            // 'associado.sexo' => ['required', 'string', 'min:1', 'max:10'],
            // 'associado.cel' => ['required', 'string', 'min:11', 'max:20'],
            // 'associado.nome_pai' => ['nullable', 'string', 'max:100'],
            // 'associado.nome_mae' => ['required', 'string', 'min:10', 'max:100'],
            // 'associado.estado_civil' => ['required', 'string', 'min:1', 'max:20'],
            // 'associado.mat' => ['required', 'string', 'min:1', 'max:50'],
            // 'associado.cod_orgao' => ['required', 'integer'],
            // 'associado.setor' => ['required', 'string', 'min:1', 'max:50'],
            // 'associado.cargo' => ['required', 'string', 'min:1', 'max:50'],
            // 'associado.ocupacao' => ['required', 'string', 'min:1', 'max:15'],
            // 'associado.data_admissao' => ['required', 'string'],

            'financeiro.cod_corretor' => ['required', 'integer'],
            'financeiro.data_proposta' => ['required', 'string'],
            'financeiro.valor_financiado' => ['required', 'decimal:2'],
            'financeiro.valor_liberado' => ['nullable', 'decimal:2'],
            'financeiro.valor_parcela' => ['required', 'decimal:2'],
            'financeiro.valor_mensalidade' => ['required', 'decimal:2'],
            'financeiro.prazo' => ['required', 'integer'],
            'financeiro.tipo_proposta' => ['nullable', 'string', 'max:50'],
            'financeiro.iof' => ['required', 'decimal:2'],
            'financeiro.taxa' => ['required', 'numeric:strict'],
            'financeiro.fonte_pagamento' => ['nullable', 'integer'],

            // 'endereco.cep' => ['required', 'string', 'min:1', 'max:10'],
            // 'endereco.uf' => ['required', 'string', 'max:2'],
            // 'endereco.municipio' => ['required', 'string', 'max:50'],
            // 'endereco.bairro' => ['required', 'string', 'max:50'],
            // 'endereco.endereco' => ['required', 'string', 'max:100'],

            // 'bancoContraCheque.banco' => ['required', 'string', 'max:10'],
            // 'bancoContraCheque.agencia' => ['required', 'string', 'max:10'],
            // 'bancoContraCheque.conta' => ['required', 'string', 'max:25'],

            // 'bancoRecebimento.chave_pix' => ['required', 'string','min:5', 'max:10'],
            // 'bancoRecebimento.banco_pagamento' => ['required', 'string', 'max:10'],
            // 'bancoRecebimento.agencia_pagamento' => ['required', 'string', 'max:25'],
            // 'bancoRecebimento.conta_pagamento' => ['required', 'string', 'max:10'],
            // 'bancoRecebimento.tipo_bancario' => ['nullable', 'string', 'max:10'],
        ];
    }
    public function prepareForValidation()
    {
        
    }
    public function messages(): array
    {
        return [
            'required' => 'Campo obrigatório.',
            'min' => 'Mínimo de :min caracteres.',
            'max' => 'Máximo de :max caracteres.',
            'date' => 'Data invalida.'
        ];
    }
}
