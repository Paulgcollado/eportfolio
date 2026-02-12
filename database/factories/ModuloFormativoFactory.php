<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuloFormativo>
 */
class ModuloFormativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ciclo_formativo_id' => CicloFormativo::factory(),
            'nombre' => fake()->words(3, true),
            'codigo' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'horas_totales' => fake()->numberBetween(20, 200),
            'curso_escolar' => fake()->words(3, true),
            'centro' => fake()->words(3, true),
            'docente_id' => User::factory(),
            'descripcion' => fake()->paragraph(2)
        ];
    }
}
