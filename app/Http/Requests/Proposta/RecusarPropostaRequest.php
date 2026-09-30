<?php

namespace App\Http\Requests\Proposta;

use Illuminate\Foundation\Http\FormRequest;

class RecusarPropostaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'motivo' => [
                'required',
                'string',
                'max:100'
            ]
        ];
    }
}
