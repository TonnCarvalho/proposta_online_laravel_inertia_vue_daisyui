<?php

use App\Models\Associado;
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
        Schema::create('refinanciamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Usuario::class, 'id_usuario')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Proposta::class, 'id_proposta')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Associado::class, 'id_associado')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('num_proposta1');
            $table->double('saldo_devedor1');
            $table->double('valor_parcela1');
            $table->integer('num_proposta2')->nullable();
            $table->double('saldo_devedor2')->nullable();
            $table->double('valor_parcela2')->nullable();
            $table->integer('num_proposta3')->nullable();
            $table->double('saldo_devedor3')->nullable();
            $table->double('valor_parcela3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refinanciamentos');
    }
};
