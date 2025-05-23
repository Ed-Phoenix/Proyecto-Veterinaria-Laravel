<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'especie',
        'raza',
        'sexo',
        'user_id', // <-- esto es lo que faltaba
    ];

    // Opcional: relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}