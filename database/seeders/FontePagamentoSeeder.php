<?php

namespace Database\Seeders;

use App\Models\FontePagamento;
use Illuminate\Database\Seeder;

class FontePagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fonte_pagamento = [
            [
                'fonte' => 'BMP',
                'saldo' => fake()->numerify('######.##'),
                'ativo' => true,
            ],
            [
                'fonte' => 'DelFinance',
                'saldo' => fake()->numerify('######.##'),
                'ativo' => true,
            ],
        ];

        FontePagamento::upsert($fonte_pagamento, ['fonte']);
    }
}
