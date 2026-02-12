<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarea::truncate();
        Tarea::factory(50)->create();
        $this->command->info('¡Tabla TAREAS inicializada con datos!');
    }
}
