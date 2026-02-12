<?php

namespace Database\Seeders;

use App\Models\Asignaciones;
use Illuminate\Database\Seeder;

class AsignacionesTableSeeder extends Seeder
{
    public function run(): void
    {
        Asignaciones::truncate();

        foreach (self::$asignaciones as $asignacion) {
            Asignaciones::insert([
                'evidencia_id' => $asignacion['evidencia_id'],
                'revisor_id' => $asignacion['revisor_id'],
                'asignado_por_id' => $asignacion['asignado_por_id'],
                'fecha_limite' => $asignacion['fecha_limite'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('¡Tabla ASIGNACIONES inicializada con datos!');
    }

    public static $asignaciones = [
        ['evidencia_id' => 1, 'revisor_id' => 2, 'asignado_por_id' => 1, 'fecha_limite' => '2024-12-31'],
        ['evidencia_id' => 2, 'revisor_id' => 3, 'asignado_por_id' => 1, 'fecha_limite' => '2024-12-31'],
        ['evidencia_id' => 3, 'revisor_id' => 1, 'asignado_por_id' => 2, 'fecha_limite' => '2024-12-31'],
        ['evidencia_id' => 4, 'revisor_id' => 2, 'asignado_por_id' => 3, 'fecha_limite' => '2024-12-31'],
        ['evidencia_id' => 5, 'revisor_id' => 3, 'asignado_por_id' => 1, 'fecha_limite' => '2024-12-31'],
    ];
}
