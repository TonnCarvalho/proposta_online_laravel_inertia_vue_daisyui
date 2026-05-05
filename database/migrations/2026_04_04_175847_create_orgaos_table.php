<?php

use App\Models\Origem;
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
        Schema::create('orgaos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Origem::class, 'id_origem')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
                $table->integer('cod_orgao');
                $table->string('nome', 255);
                $table->boolean('ativo')->default(true);
                $table->unique(['id_origem', 'cod_orgao']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgaos');
    }
};
