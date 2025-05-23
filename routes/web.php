<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Mascotas\MascotaIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
}); 

        Route::middleware(['role:admin'])->group(function () {
        // Rutas solo para administradores
        });

        Route::middleware(['role:persona'])->group(function () {
            // Rutas para personas normales
        });

        Route::middleware(['role:veterinario'])->group(function () {
            // Rutas para veterinarios
        });

        Route::middleware(['role:admin|veterinario'])->group(function () {
        // Acceso compartido entre admin y veterinarios
        });

Route::middleware(['auth', 'role:persona'])->group(function () {
    Route::get('/mascotas', MascotaIndex::class)->name('mascotas.index');
});

require __DIR__.'/auth.php';
