<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
      'user_id','mascota_id','veterinario_id','horario_id',
      'asunto','descripcion','estado'
    ];

    public function persona()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function nota()
    {
        return $this->hasOne(Nota::class);
    }
}
