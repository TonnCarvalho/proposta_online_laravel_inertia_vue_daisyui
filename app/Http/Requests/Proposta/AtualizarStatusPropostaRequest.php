<?php

namespace App\Http\Requests\Proposta;

use App\Enum\StatusProposta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarStatusPropostaRequest extends FormRequest
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
                Rule::enum(StatusProposta::class)
            ]
        ];
    }
}
