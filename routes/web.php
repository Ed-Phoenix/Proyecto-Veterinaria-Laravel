<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VeterinarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\CitaController;
use App\Livewire\Admin\ProductosCrud;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Rutas solo para admin
Route::middleware(['auth'])->group(function () {
    Route::resource('veterinarios', VeterinarioController::class);
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('veterinarios', VeterinarioController::class);
    });
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('productos', ProductoController::class); // <-- mover aquí
        Route::get('/admin/productos', ProductosCrud::class)->name('admin.productos');
    });
});

// Rutas solo para veterinarios
Route::middleware(['auth'])->group(function () {
    Route::get('mis-horarios', [HorarioController::class, 'index']);
    // demás rutas de veterinario...

    // Ruta con nombre 'horarios.index' para compatibilidad con los menús/blade
    Route::get('horarios', fn() => view('vet.horarios'))->name('horarios.index');

    // Ruta para citas pendientes del veterinario
    Route::get('citas-vet', fn() => view('vet.citas'))->name('citas.vet');

    Route::middleware(['role:veterinario'])
        ->prefix('vet')
        ->name('vet.')
        ->group(function () {
            Route::get('horarios', fn() => view('vet.horarios'))
                ->name('horarios.index');
            Route::get('citas/pendientes', fn() => view('vet.citas.pendientes'))
                ->name('citas.pendientes.index');
            Route::get('citas/confirmadas', fn() => view('vet.citas.confirmadas'))
                ->name('citas.confirmadas.index');
            Route::post('citas/{cita}/confirmar', 
                [\App\Http\Controllers\Vet\CitaVetController::class, 'confirmar'])
                ->name('citas.confirmar');
            Route::get('citas/{cita}/anotaciones',
                [\App\Http\Controllers\Vet\CitaVetController::class, 'showAnotaciones'])
                ->name('citas.anotaciones');
            Route::post('citas/{cita}/anotaciones',
                [\App\Http\Controllers\Vet\CitaVetController::class, 'guardarAnotacion']);
            Route::get('citas/{cita}/reporte',
                [\App\Http\Controllers\Vet\CitaVetController::class, 'generarReporte'])
                ->name('citas.reporte');
        });
});

// Alias para compatibilidad con los menús/blade
Route::middleware(['auth', 'role:veterinario'])->group(function () {
    Route::get('vet/citas/pendientes', fn() => view('vet.citas.pendientes'))
        ->name('citas.pendientes.index');
    Route::get('vet/citas/confirmadas', fn() => view('vet.citas.confirmadas'))
        ->name('citas.confirmadas.index');
});

// Rutas para personas autenticadas (sin 'role:persona')
Route::middleware(['auth'])->group(function () {
    Route::resource('mascotas', MascotaController::class);
    Route::resource('citas', CitaController::class);
    Route::get('citas', function() {
        return view('persona.citas');
    })->name('citas.index');
    // catálogo y carrito...
});

// Vista personalizada para mascotas
Route::get('mascotas', function () {
    return view('persona.mascotas');
})->name('mascotas.index');

// Rutas solo para personas (role:persona)
Route::get('tienda', function(){ return view('persona.tienda'); })
     ->name('tienda.index')
     ->middleware(['auth','role:persona']);

Route::get('carrito', function(){ return view('persona.carrito'); })
     ->name('carrito.index')
     ->middleware(['auth','role:persona']);

require __DIR__.'/auth.php';