<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            OrigemSeeder::class,
            OrgaoSeeder::class,
            AssociadoSeeder::class,
            FontePagamentoSeeder::class,
            PropostaSeeder::class,
        ]);
    }
}
