<?php

namespace Database\Factories;

use App\Models\Associado;
use App\Models\Orgao;
use App\Models\Origem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Associado>
 */
class AssociadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_usuario' => '1',
            'id_origem' => Origem::inRandomOrder()->first()?->id,
            'id_orgao' => Orgao::inRandomOrder()->first()?->id,

            'cod_corretor' => fake()->randomElement([100, 1000]), 

            'nome' => fake()->name(),

            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'rg' => fake()->numerify('########'),

            'orgao_exp' => 'SSP',

            'naturalidade' => fake()->city(),

            'data_nasc' => fake()->date('Y-m-d', '-18 years'),

            'sexo' => fake()->randomElement(['M', 'F']),

            'estado_civil' => fake()->randomElement([
                'solteiro',
                'casado',
                'divorciado',
                'viuvo',
            ]),

            'ddd_tel' => fake()->numerify('##'),
            'tel' => fake()->numerify('#########'),

            'ddd_cel' => fake()->numerify('##'),
            'cel' => fake()->numerify('#########'),

            'email' => fake()->unique()->safeEmail(),

            'nome_pai' => fake()->optional()->firstNameMale().' '.fake()->lastName(),
            'nome_mae' => fake()->firstNameMale().' '.fake()->lastName(),

            'matricula' => fake()->numerify('######'),

            'setor' => fake()->randomElement([
                'Administrativo',
                'Financeiro',
                'RH',
                'Educação',
                'Saúde',
                'Segurança',
                'Atendimento',
            ]),
            'cargo' => fake()->randomElement([
                'Analista',
                'Assistente',
                'Auxiliar',
                'Professor',
                'Técnico',
                'Agente Público',
                'Coordenador',
                'Supervisor',
                'Motorista',
                'Enfermeiro',
            ]),

            'ocupacao' => fake()->randomElement([
                'ativo',
                'aposentado',
                'pencionista',
            ]),

            'data_admissao' => fake()->date(),

            'cep' => fake()->numerify('#####-###'),

            'uf' => fake()->randomElement([
                'BA',
                'PB',
                'SE',
            ]),
            'localidade' => fake()->city(),
            'bairro' => fake()->streetName(),
            'logradouro' => fake()->streetAddress(),

            'numero' => fake()->buildingNumber(),

            'complemento' => fake()->secondaryAddress(),

            'banco' => fake()->randomElement([
                'Banco do Brasil',
                'Caixa',
                'Bradesco',
                'Itaú',
                'Santander',
            ]),

            'agencia' => fake()->numberBetween(1000, 9999),
            'digito_agencia' => fake()->optional()->numberBetween(0, 9),

            'conta' => fake()->numberBetween(10000, 999999),
            'digito_conta' => fake()->optional()->numberBetween(0, 9),

            'banco_pagamento' => fake()->numberBetween(1, 999),
            'agencia_pagamento' => fake()->numberBetween(1000, 9999),
            'digito_agencia_pagamento' => fake()->optional()->numberBetween(0, 9),

            'conta_pagamento' => fake()->numberBetween(10000, 999999),
            'digito_conta_pagamento' => fake()->optional()->numberBetween(0, 9),

            'tipo_conta_bancaria' => fake()->randomElement(['c', 'p']),

            'ativo' => true,
        ];
    }
}
