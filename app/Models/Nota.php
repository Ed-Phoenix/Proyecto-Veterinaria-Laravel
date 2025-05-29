<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['cita_id', 'contenido'];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}
