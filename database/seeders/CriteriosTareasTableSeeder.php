<?php

namespace Database\Seeders;

use App\Models\CriteriosTareas;
use Illuminate\Database\Seeder;

class CriteriosTareasTableSeeder extends Seeder
{
    public function run(): void
    {
        CriteriosTareas::truncate();

        foreach (self::$criterios_tareas as $ct) {
            CriteriosTareas::insert([
                'tarea_id' => $ct['tarea_id'],
                'criterio_evaluacion_id' => $ct['criterio_evaluacion_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        CriteriosTareas::factory(10)->create();
        $this->command->info('¡Tabla CRITERIOS TAREAS inicializada con datos!');
    }

    public static $criterios_tareas = [
        ['tarea_id' => 1, 'criterio_evaluacion_id' => 1],
        ['tarea_id' => 2, 'criterio_evaluacion_id' => 2],
        ['tarea_id' => 3, 'criterio_evaluacion_id' => 3],
        ['tarea_id' => 4, 'criterio_evaluacion_id' => 4],
        ['tarea_id' => 5, 'criterio_evaluacion_id' => 5],
        ['tarea_id' => 6, 'criterio_evaluacion_id' => 6],
        ['tarea_id' => 7, 'criterio_evaluacion_id' => 7],
        ['tarea_id' => 8, 'criterio_evaluacion_id' => 8],
        ['tarea_id' => 9, 'criterio_evaluacion_id' => 9],
        ['tarea_id' => 10, 'criterio_evaluacion_id' => 10],
    ];
}
