<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mascota;
use App\Models\Veterinario;
use App\Models\Horario;
use App\Models\Cita;
use App\Models\Producto;
use App\Models\Anotacion;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios normales
        User::factory(10)->has(
            Mascota::factory()->count(2)
        )->create();

        // Crear veterinarios con usuarios
        Veterinario::factory(5)->has(
            Horario::factory()->count(3)
        )->create();

        // Crear productos
        Producto::factory(10)->create();

        // Crear citas con anotaciones
        Cita::factory(10)->has(
            Anotacion::factory()
        )->create();
    }
}
