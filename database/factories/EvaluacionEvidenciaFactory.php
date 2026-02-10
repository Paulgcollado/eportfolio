<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvaluacionEvidencia>
 */
class EvaluacionEvidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'evidencia_id' => fake()->numberBetween(1, 80),
            'user_id' => fake()->numberBetween(1, 11),
            'puntuacion' => fake()->randomFloat(2, 0, 10),
            'estado' => fake()->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => fake()->text(50),
        ];
    }
}
