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
        Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')             // veterinario
              ->constrained('users')
              ->onDelete('cascade');
        $table->date('fecha');                   // día de disponibilidad
        $table->time('hora_inicio');             // hora de inicio de la franja
        $table->time('hora_fin');                // hora fin
        $table->integer('duracion_minutos')      // duración de cada cita (p.ej. 30)
              ->default(30);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
