<?php

use App\Models\Orgao;
use App\Models\Origem;
use App\Models\Usuario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Origem::class, 'id_origem')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Orgao::class, 'id_orgao')
                ->constrained()
                ->cascadeOnUpdate();
            $table->integer('cod_corretor')->index();
            $table->string('nome', 50);
            $table->string('sobrenome', 50);
            $table->string('cpf', 14)->index();
            $table->string('rg', 50);
            $table->string('orgao_exp', 10);
            $table->string('naturalidade', 50);
            $table->date('data_nasc');
            $table->enum('sexo', ['M', 'F']);
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo']);
            $table->string('ddd_tel', 2);
            $table->string('tel', 9);
            $table->string('ddd_cel', 2);
            $table->string('cel', 9);
            $table->string('email', 50);
            $table->string('nome_pai', 100)->nullable();
            $table->string('nome_mae', 100);
            $table->string('matricula', 50);
            $table->string('setor', 50);
            $table->string('cargo', 50);
            $table->enum('ocupacao', ['ativo', 'aposentado', 'pencionista']);
            $table->date('data_admissao');
            $table->string('cep', 9);
            $table->string('uf', 2);
            $table->string('localidade', 50);
            $table->string('bairro', 50);
            $table->string('logradouro', 50);
            $table->string('numero', 5);
            $table->string('complemento', 50);
            $table->string('banco');
            $table->integer('agencia');
            $table->integer('digito_agencia')->nullable();
            $table->integer('conta');
            $table->integer('digito_conta')->nullable();
            $table->integer('banco_pagamento');
            $table->integer('agencia_pagamento');
            $table->integer('digito_agencia_pagamento')->nullable();
            $table->integer('conta_pagamento');
            $table->integer('digito_conta_pagamento')->nullable();
            $table->enum('tipo_conta_bancaria', ['c', 'p']);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associados');
    }
};
