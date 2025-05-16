<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'mascota_id' => \App\Models\Mascota::factory(),
            'veterinario_id' => \App\Models\Veterinario::factory(),
            'asunto' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'fecha' => $this->faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d'),
            'hora' => $this->faker->time('H:i'),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada']),
        ];
    }

}
