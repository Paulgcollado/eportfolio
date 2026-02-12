<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // En primer lugar borramos el contenido de la tabla users
        User::truncate();

        // Creación del usuario administrador y la creación de los 10 usuarios
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->command->info('¡Tabla USUARIOS inicializada con datos!');
    }
}
