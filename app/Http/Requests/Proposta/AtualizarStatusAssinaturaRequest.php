<?php

namespace App\Http\Requests\Proposta;

use App\Enum\StatusAssinatura;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarStatusAssinaturaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'integer',
                Rule::enum(StatusAssinatura::class)
            ]
        ];
    }
}
