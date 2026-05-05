<?php

use App\Models\Proposta;
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
        Schema::create('acompanhamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario');
            $table->foreignIdFor(Proposta::class, 'id_proposta');
            $table->string('status_proposta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompanhamentos');
    }
};
