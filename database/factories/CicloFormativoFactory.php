<?php

namespace Database\Factories;

use App\Models\FamiliaProfesional;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CicloFormativo>
 */
class CicloFormativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'familia_profesional_id' => FamiliaProfesional::factory(),
            'nombre' => fake()->name(),
            'codigo' => fake()->unique()->text(5),
            'grado' => fake()->randomElement(['basico', 'medio', 'superior']),
            'descripcion' => fake()->text(50),
        ];
    }
}
