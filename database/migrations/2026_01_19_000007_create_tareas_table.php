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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('criterios_evaluacion_id')->nullable();
            $table->foreign('criterios_evaluacion_id')->references('id')->on('criterios_evaluacion')->onDelete('cascade');

            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre');
            $table->boolean('activo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
