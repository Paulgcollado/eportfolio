<?php

namespace Database\Factories;

use App\Models\CriterioEvaluacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evidencia>
 */
class EvidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estudiante_id' => User::factory(),
            'criterio_evaluacion_id' => CriterioEvaluacion::factory(),
            'url' => fake()->url(),
            'descripcion' => fake()->paragraph(2),
            'estado_validacion' => fake()->randomElement(['pendiente', 'validada', 'rechazada'])
        ];
    }
}
