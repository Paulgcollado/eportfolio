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
            //$table->foreignId('modulo_formativo_id')->constrained('ciclos_formativos')->onDelete('cascade'); //ciclo_formativo (tabla)
            $table->string('codigo', 50);
            $table->string('descripcion');
            $table->float('peso_porcentaje')->min(0)->max(100);
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
