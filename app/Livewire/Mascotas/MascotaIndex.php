<?php

namespace App\Livewire\Mascotas;

use App\Models\Mascota;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MascotaIndex extends Component
{
    public $nombre, $edad, $especie, $raza, $sexo, $mascota_id;
    public $modo_edicion = false;

     public function render()
    {
        $mascotas = Mascota::where('user_id', Auth::id())->get();
        return view('livewire.mascotas.mascota-index', compact('mascotas'));
    }

    public function resetCampos()
    {
        $this->reset(['nombre', 'edad', 'especie', 'raza', 'sexo', 'mascota_id', 'modo_edicion']);
    }

    public function guardar()
    {
        $this->validate([
            'nombre' => 'required',
            'edad' => 'required|integer',
            'especie' => 'required',
            'raza' => 'required',
            'sexo' => 'required|in:macho,hembra',
        ]);

        Mascota::create([
            'user_id' => Auth::id(),
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'especie' => $this->especie,
            'raza' => $this->raza,
            'sexo' => $this->sexo,
        ]);

        $this->resetCampos();
        session()->flash('mensaje', 'Mascota registrada correctamente.');
    }

     public function editar($id)
    {
        $mascota = Mascota::findOrFail($id);
        $this->mascota_id = $mascota->id;
        $this->nombre = $mascota->nombre;
        $this->edad = $mascota->edad;
        $this->especie = $mascota->especie;
        $this->raza = $mascota->raza;
        $this->sexo = $mascota->sexo;
        $this->modo_edicion = true;
    }

     public function actualizar()
    {
        $this->validate([
            'nombre' => 'required',
            'edad' => 'required|integer',
            'especie' => 'required',
            'raza' => 'required',
            'sexo' => 'required|in:macho,hembra',
        ]);

        $mascota = Mascota::findOrFail($this->mascota_id);
        $mascota->update([
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'especie' => $this->especie,
            'raza' => $this->raza,
            'sexo' => $this->sexo,
        ]);

        $this->resetCampos();
        session()->flash('mensaje', 'Mascota actualizada.');
    }

    public function eliminar($id)
    {
        Mascota::destroy($id);
        session()->flash('mensaje', 'Mascota eliminada.');
    }
}
