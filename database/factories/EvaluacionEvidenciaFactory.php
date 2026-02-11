<?php

namespace Database\Factories;

use App\Models\Evidencia;
use App\Models\User;
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
            'evidencia_id' => Evidencia::factory(),
            'user_id' => User::factory(),
            'puntuacion' => fake()->randomFloat(2, 0, 10),
            'estado_validacion' => fake()->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'observaciones' => fake()->paragraph(),
        ];
    }
}
