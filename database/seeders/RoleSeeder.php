<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'persona']);
        Role::firstOrCreate(['name' => 'veterinario']);
        Role::firstOrCreate(['name' => 'admin']);
    }
}
