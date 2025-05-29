<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin Demo',
            'email' => 'admin@veterinaria.test',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $vet = User::factory()->create([
            'name' => 'Vet Demo',
            'email' => 'vet@veterinaria.test',
            'password' => Hash::make('password'),
        ]);
        $vet->assignRole('veterinario');

        $person = User::factory()->create([
            'name' => 'Persona Demo',
            'email' => 'persona@veterinaria.test',
            'password' => Hash::make('password'),
        ]);
        $person->assignRole('persona');
    }
}
