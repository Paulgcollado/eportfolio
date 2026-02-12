<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::truncate();
        foreach (self::$roles as $rol) {
            Rol::insert(["name" => $rol]);
        }
        $this->command->info('¡Tabla ROLES inicializada con datos!');
    }

    public static $roles = [
        "Administrador",
        "Docente",
        "Estudiante"
    ];
}
