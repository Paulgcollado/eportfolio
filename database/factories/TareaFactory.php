<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'criterios_evaluacion_id' => fake()->numberBetween(1, 22),
            'fecha_apertura' => fake()->dateTime(),
            'fecha_cierre' => fake()->dateTime(),
            'activo' => fake()->boolean(50),
            'observaciones' => fake()->text(100)
        ];
    }
}
