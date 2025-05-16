<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition(): array
        {
            $fecha = $this->faker->dateTimeBetween('now', '+1 week')->format('Y-m-d');
            return [
                'veterinario_id' => \App\Models\Veterinario::factory(),
                'fecha' => $fecha,
                'hora_inicio' => '09:00',
                'hora_fin' => '17:00',
            ];
        }
    
}
