<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Veterinario;

use Spatie\Permission\Models\Role;

class UsersWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        $admin = User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@vetapp.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // VETERINARIO
        $veterinarioUser = User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'veterinario@vetapp.com',
            'password' => Hash::make('password'),
        ]);
        $veterinarioUser->assignRole('veterinario');

        // También crea su entrada en la tabla veterinarios
        Veterinario::create([
            'user_id' => $veterinarioUser->id,
            'especialidad' => 'Animales exóticos',
        ]);

        // PERSONA
        $persona = User::create([
            'name' => 'Carlos Gómez',
            'email' => 'persona@vetapp.com',
            'password' => Hash::make('password'),
        ]);
        $persona->assignRole('persona');
    }
}
