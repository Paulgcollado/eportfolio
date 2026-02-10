<?php

namespace Database\Factories;

use App\Models\ModuloFormativo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResultadoAprendizaje>
 */
class ResultadoAprendizajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modulo_formativo_id' => ModuloFormativo::factory(),
            'codigo' => fake()->unique()->text(20),
            'descripcion' => fake()->text(50),
            'peso_porcentaje' => fake()->randomFloat(3, 2),
            'orden' => fake()->randomNumber(),
        ];
    }
}
