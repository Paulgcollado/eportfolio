<?php

namespace Database\Seeders;

use App\Models\EvaluacionEvidencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluacionesEvidenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EvaluacionEvidencia::truncate();
        EvaluacionEvidencia::factory(40)->create();
        $this->command->info('¡Tabla EVALUACIONES EVIDENCIAS inicializada con datos!');
    }
}
