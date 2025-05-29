<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = ['user_id','nombre','edad','especie','raza','sexo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
