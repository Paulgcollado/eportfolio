<?php

namespace Database\Factories;

use App\Models\FamiliaProfesional;
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
            'nombre' => fake()->word(),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'grado' => fake()->randomElement(['basico', 'medio', 'superior']),
            'descripcion' => fake()->paragraph(),
        ];
    }
}
