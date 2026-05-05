<?php

namespace Database\Seeders;

use App\Models\Associado;
use App\Models\FontePagamento;
use App\Models\Proposta;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = Usuario::pluck('id');
        $associados = Associado::all();
        $fontes = FontePagamento::pluck('id');

        $propostas = [];

        foreach ($associados as $index => $associado) {

            $valorFinanciado = fake()->randomFloat(2, 1000, 20000);
            $prazo = fake()->numberBetween(6, 60);

            $valorParcela = $valorFinanciado / $prazo;

            $propostas[] = [
                'id_usuario' => $usuarios->random(),
                'id_associado' => $associado->id,

                // 🔥 importante: origem vem do associado
                'id_origem' => $associado->id_origem,

                'id_fonte_pagamento' => $fontes->random(),

                // 🔥 regra real: vem do associado
                'cod_corretor' => $associado->cod_corretor,

                'num_proposta' => 100000 + $index,

                'valor_financiado' => $valorFinanciado,
                'valor_liberado' => $valorFinanciado * 0.9,
                'valor_parcela' => $valorParcela,
                'valor_mensalidade' => $valorParcela,

                'iof' => fake()->randomFloat(2, 0, 50),
                'taxa' => fake()->randomFloat(2, 1, 5),

                'prazo' => $prazo,

                'status_proposta' => fake()->randomElement([1, 2, 3, 4, 5]),
                'status_recusado' => false,
                'status_assinatura' => fake()->numberBetween(0, 2),
                'status_refin' => false,

                'tipo_proposta' => fake()->randomElement([
                    'novo',
                    'refinanciamento'
                ]),

                'recusado_motivo' => null,

                'tipo_assinatura' => fake()->randomElement([
                    'digital',
                    'manual'
                ]),

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Proposta::insert($propostas);
    }
}
