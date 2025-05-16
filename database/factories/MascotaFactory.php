<?php

namespace Database\Factories;
use App\Models\Mascota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascota>
 */
class MascotaFactory extends Factory
{
    protected $model = Mascota::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
            'user_id' => \App\Models\User::factory(),
            'nombre' => $this->faker->firstName,
            'edad' => $this->faker->numberBetween(1, 15),
            'especie' => $this->faker->randomElement(['Perro', 'Gato']),
            'raza' => $this->faker->word,
            'sexo' => $this->faker->randomElement(['macho', 'hembra']),
        ];
    }
}
