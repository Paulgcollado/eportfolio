<?php

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
        Schema::create('resultados_aprendizaje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_formativo_id')->constrained('modulos_formativos')->onDelete('cascade');
            $table->string('codigo', 50);
            $table->string('descripcion');
            $table->decimal('peso_procentaje', 3, 2)->min(0.00)->max(100.00);
            $table->integer('orden')->min(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_aprendizaje');
    }
};
