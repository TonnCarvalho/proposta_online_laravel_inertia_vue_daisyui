<?php

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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Origem::class, 'id_origem')
                ->constrained()
                ->cascadeOnUpdate();
            $table->string('email', 50);
            $table->boolean('status_consulta')->default(false);
            $table->string('nome1', 100);
            $table->string('cpf1', 14);
            $table->date('data_nascimento1');
            $table->integer('matricula1');
            $table->string('nome2', 100)->nullable();
            $table->string('cpf2', 14)->nullable();
            $table->integer('matricula2')->nullable();
            $table->date('data_nascimento2')->nullable();
            $table->string('nome3', 100)->nullable();
            $table->string('cpf3', 14)->nullable();
            $table->integer('matricula3')->nullable();
            $table->date('data_nascimento3')->nullable();
            $table->string('nome4', 100)->nullable();
            $table->string('cpf4', 14)->nullable();
            $table->integer('matricula4')->nullable();
            $table->date('data_nascimento4')->nullable();
            $table->string('nome5', 100)->nullable();
            $table->string('cpf5', 14)->nullable();
            $table->integer('matricula5')->nullable();
            $table->date('data_nascimento5')->nullable();
            $table->string('nome6', 100)->nullable();
            $table->string('cpf6', 14)->nullable();
            $table->integer('matricula6')->nullable();
            $table->date('data_nascimento6')->nullable();
            $table->string('nome7', 100)->nullable();
            $table->string('cpf7', 14)->nullable();
            $table->integer('matricula7')->nullable();
            $table->date('data_nascimento7')->nullable();
            $table->string('nome8', 100)->nullable();
            $table->string('cpf8', 14)->nullable();
            $table->integer('matricula8')->nullable();
            $table->date('data_nascimento8')->nullable();
            $table->string('nome9', 100)->nullable();
            $table->string('cpf9', 14)->nullable();
            $table->integer('matricula9')->nullable();
            $table->date('data_nascimento9')->nullable();
            $table->string('nome10', 100)->nullable();
            $table->string('cpf10', 14)->nullable();
            $table->integer('matricula10')->nullable();
            $table->date('data_nascimento10')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
