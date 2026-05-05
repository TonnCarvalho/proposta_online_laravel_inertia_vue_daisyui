<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'nome' => 'Admin',
                'cod_corretor' => '100',
                'password' => Hash::make('123456'),
                'cpf' => '060.060.655-02',
                'email' => 'admin@email.com',
                'ddd_tel' => '71',
                'tel' => '987654321',
                'ddd_cel' => '71',
                'cel' => '987654321',
                'uf' => 'BA',
                'localidade' => 'Lauro de Freitas',
                'ativo' => true,
                'atualizado' => true,
            ],
            [
                'nome' => 'Corretor',
                'cod_corretor' => '1000',
                'password' => Hash::make('123456'),
                'cpf' => '061.060.655-02',
                'email' => 'corretor@email.com',
                'ddd_tel' => '71',
                'tel' => '987654321',
                'ddd_cel' => '71',
                'cel' => '987654321',
                'uf' => 'BA',
                'localidade' => 'Lauro de Freitas',
                'ativo' => true,
                'atualizado' => true,
            ],
        ];

        Usuario::upsert($usuarios, ['cod_corretor']);
    }
}
