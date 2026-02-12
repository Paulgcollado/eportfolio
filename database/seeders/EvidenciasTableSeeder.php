<?php

namespace Database\Seeders;

use App\Models\Evidencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvidenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evidencia::truncate();
        Evidencia::factory(80)->create();
        $this->command->info('¡Tabla EVIDENCIAS inicializada con datos!');
    }
}
