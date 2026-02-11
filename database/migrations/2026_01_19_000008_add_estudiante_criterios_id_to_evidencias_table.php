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
        Schema::table('evidencias', function (Blueprint $table) {
            $table->unsignedBigInteger("estudiante_id")->nullable();
            $table->foreign("estudiante_id")->references("id")->on("users")->onDelete("cascade");

            $table->unsignedBigInteger("criterio_evaluacion_id")->nullable();
            $table->foreign("criterio_evaluacion_id")->references("id")->on("criterios_evaluacion")->onDelete("cascade");

            $table->dropColumn('tarea_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evidencias', function (Blueprint $table) {
            $table->dropForeign('evidencias_estudiante_id_foreign');
            $table->dropColumn('estudiante_id');

            $table->dropForeign('evidencias_criterio_evaluacion_id_foreign');
            $table->dropColumn('criterio_evaluacion_id');
        });
    }
};
