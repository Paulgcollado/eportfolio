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
        Schema::create('criterios_tareas', function (Blueprint $table) {
            $table->unsignedBigInteger("tarea_id")->nullable();
            $table->foreign("tarea_id")->references("id")->on("tareas")->onDelete("cascade");

            $table->unsignedBigInteger("criterio_evaluacion_id")->nullable();
            $table->foreign("criterio_evaluacion_id")->references("id")->on("criterios_evaluacion")->onDelete("cascade");

            $table->primary(['tarea_id', 'criterio_evaluacion_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterios_tareas');
    }
};
