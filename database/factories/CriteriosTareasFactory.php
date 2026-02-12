<?php

namespace Database\Factories;

use App\Models\CriterioEvaluacion;
use App\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CriteriosTareas>
 */
class CriteriosTareasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tarea_id' => Tarea::factory(),
            'criterio_evaluacion_id' => CriterioEvaluacion::factory()
        ];
    }
}
