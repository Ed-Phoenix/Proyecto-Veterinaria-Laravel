<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    use HasFactory;
    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function citas()
    {
    return $this->hasMany(Cita::class);
    }

    public function horarios()
    {
    return $this->hasMany(Horario::class);
    }
}
