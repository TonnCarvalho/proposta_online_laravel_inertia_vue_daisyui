<?php

use App\Models\Consulta;
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
        Schema::create('consultas_respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Consulta::class, 'id_consulta')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('resposta1', 100);
            $table->string('resposta2', 100)->nullable();
            $table->string('resposta3', 100)->nullable();
            $table->string('resposta4', 100)->nullable();
            $table->string('resposta5', 100)->nullable();
            $table->string('resposta6', 100)->nullable();
            $table->string('resposta7', 100)->nullable();
            $table->string('resposta8', 100)->nullable();
            $table->string('resposta9', 100)->nullable();
            $table->string('resposta10', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas_respostas');
    }
};
