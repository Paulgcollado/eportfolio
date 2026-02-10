<?php

namespace Database\Factories;

use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CriterioEvaluacion>
 */
class CriterioEvaluacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resultado_aprendizaje_id' => ResultadoAprendizaje::factory(),
            'codigo' => fake()->unique()->text(20),
            'descripcion' => fake()->text(50),
            'peso_porcentaje' => fake()->randomFloat(3, 2),
            'orden' => fake()->randomNumber()
        ];
    }
}
