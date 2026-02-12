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
                'actividad_id' => $ct['actividad_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('¡Tabla CRITERIOS TAREAS inicializada con datos!');
    }

    public static $criterios_tareas = [
        ['tarea_id' => 1, 'actividad_id' => 1],
        ['tarea_id' => 2, 'actividad_id' => 2],
        ['tarea_id' => 3, 'actividad_id' => 3],
        ['tarea_id' => 4, 'actividad_id' => 4],
        ['tarea_id' => 5, 'actividad_id' => 5],
        ['tarea_id' => 6, 'actividad_id' => 6],
        ['tarea_id' => 7, 'actividad_id' => 7],
        ['tarea_id' => 8, 'actividad_id' => 8],
        ['tarea_id' => 9, 'actividad_id' => 9],
        ['tarea_id' => 10, 'actividad_id' => 10],
    ];
}
