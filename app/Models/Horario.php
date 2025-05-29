<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
     protected $fillable = [
      'user_id', 'fecha', 'hora_inicio', 'hora_fin', 'duracion_minutos'
    ];

    public function veterinario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
