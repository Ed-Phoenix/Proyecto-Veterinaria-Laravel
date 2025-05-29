<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
          Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')           // quien agenda (persona)
              ->constrained('users')
              ->onDelete('cascade');
        $table->foreignId('mascota_id')
              ->constrained('mascotas')
              ->onDelete('cascade');
        $table->foreignId('veterinario_id')    // referenciar al usuario vet
              ->constrained('users')
              ->onDelete('cascade');
        $table->foreignId('horario_id')        // la franja que va a ocupar
              ->constrained('horarios');
        $table->string('asunto');
        $table->text('descripcion')->nullable();
        $table->enum('estado', ['pendiente','confirmada','cancelada'])
              ->default('pendiente');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
