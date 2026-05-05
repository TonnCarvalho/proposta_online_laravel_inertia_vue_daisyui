<?php

namespace Database\Seeders;

use App\Models\Origem;
use Illuminate\Database\Seeder;

class OrigemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $origens = [
            [
                'cod_local' => 2,
                'nome' => 'GOVERNO BAHIA',
                'ativo' => true,
            ],
            [
                'cod_local' => 3,
                'nome' => 'SERGIPE',
                'ativo' => false,
            ],
            [
                'cod_local' => 4,
                'nome' => 'PREFEITURA SALVADOR - BA',
                'ativo' => true,
            ],
            [
                'cod_local' => 5,
                'nome' => 'PREFEITURA ARACAJU - SE',
                'ativo' => false,
            ],
            [
                'cod_local' => 6,
                'nome' => 'GOVERNO ESPIRITO SANTO',
                'ativo' => false,
            ],
            [
                'cod_local' => 7,
                'nome' => 'ALAGOAS',
                'ativo' => false,
            ],
            [
                'cod_local' => 12,
                'nome' => 'BAHIA D',
                'ativo' => false,
            ],
            [
                'cod_local' => 13,
                'nome' => 'JOÃO PESSOA - PB',
                'ativo' => true,
            ],
            [
                'cod_local' => 15,
                'nome' => 'PARAIBA',
                'ativo' => true,
            ],
            [
                'cod_local' => 16,
                'nome' => 'JUAZEIRO - BA',
                'ativo' => false,
            ],
            [
                'cod_local' => 21,
                'nome' => 'ALAGOINHAS - BA',
                'ativo' => true,
            ],
            [
                'cod_local' => 26,
                'nome' => 'JEQUIE - BA',
                'ativo' => true,
            ],
            [
                'cod_local' => 43,
                'nome' => 'CONVENIO PARAIBA',
                'ativo' => false,
            ],
            [
                'cod_local' => 45,
                'nome' => 'BAHIA - CÂMARA - AS',
                'ativo' => false,
            ],
            [
                'cod_local' => 46,
                'nome' => 'SERGIPE - PREVIDENCIA',
                'ativo' => false,
            ],
            [
                'cod_local' => 47,
                'nome' => 'MONTE ALEGRE - SE',
                'ativo' => true,
            ],
            [
                'cod_local' => 48,
                'nome' => 'NOSSA SRA DE LOURDES - SE',
                'ativo' => true,
            ],
            [
                'cod_local' => 49,
                'nome' => 'POÇO REDONDO - SE',
                'ativo' => true,
            ],
            [
                'cod_local' => 50,
                'nome' => 'VERA CRUZ',
                'ativo' => true,
            ],
            [
                'cod_local' => 51,
                'nome' => 'JAGUARARI - BA',
                'ativo' => true,
            ],
            [
                'cod_local' => 52,
                'nome' => 'PEDRAS DE FOGO - PB',
                'ativo' => false,
            ],
            [
                'cod_local' => 53,
                'nome' => 'MATRIZ DE CAMARAGIBE - AL',
                'ativo' => false,
            ],
            [
                'cod_local' => 54,
                'nome' => 'GUANAMBI',
                'ativo' => true,
            ],
            [
                'cod_local' => 55,
                'nome' => 'AURELINO LEAL - BA',
                'ativo' => true,
            ],
            [
                'cod_local' => 56,
                'nome' => 'NOSSA SENHORA DAS DORES - SE',
                'ativo' => true,
            ],
            [
                'cod_local' => 57,
                'nome' => 'NOSSA SRA DO SOCORRO - SE',
                'ativo' => true,
            ],
        ];

        Origem::upsert($origens, ['cod_local']);

    }
}
