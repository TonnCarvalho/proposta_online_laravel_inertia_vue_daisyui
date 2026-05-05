<?php

use App\Models\Associado;
use App\Models\FontePagamento;
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
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Associado::class, 'id_associado')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Origem::class, 'id_origem')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(FontePagamento::class, 'id_fonte_pagamento')
                ->constrained()
                ->cascadeOnUpdate();
            $table->integer('cod_corretor');
            $table->integer('num_proposta');
            $table->double('valor_financiado')->nullable();
            $table->double('valor_liberado')->nullable();
            $table->double('valor_parcela')->nullable();
            $table->double('valor_mensalidade')->nullable();
            $table->double('iof')->nullable();
            $table->double('taxa')->nullable();
            $table->integer('prazo');
            $table->integer('status_proposta')->default(1);
            $table->boolean('status_recusado')->default(false);
            $table->integer('status_assinatura')->default(0);
            $table->boolean('status_refin')->default(false);
            $table->string('tipo_proposta', 20)->nullable();
            $table->string('recusado_motivo', 100)->nullable();
            $table->enum('tipo_assinatura', ['digital', 'manual']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
