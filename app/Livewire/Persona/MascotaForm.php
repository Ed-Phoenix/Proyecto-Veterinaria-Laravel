<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class MascotaForm extends Component
{
    public $mascotaId;
    public $nombre, $edad, $especie, $raza, $sexo;

    protected $listeners = [
        'editMascota' => 'loadMascota',
        'mascotaActualizada' => 'render'
    ];

    protected $rules = [
        'nombre'  => 'required|string|max:50',
        'edad'    => 'required|integer|min:0|max:100',
        'especie' => 'required|string|max:30',
        'raza'    => 'required|string|max:30',
        'sexo'    => 'required|in:M,F',
    ];

    public function render()
    {
        return view('livewire.persona.mascota-form');
    }

    public function loadMascota($id = null)
    {
        if ($id) {
            $m = Mascota::findOrFail($id);
            abort_unless($m->user_id === Auth::id(), 403);
            $this->mascotaId = $m->id;
            $this->fill($m->toArray());
        } else {
            $this->reset(['mascotaId','nombre','edad','especie','raza','sexo']);
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
          'nombre'  => $this->nombre,
          'edad'    => $this->edad,
          'especie' => $this->especie,
          'raza'    => $this->raza,
          'sexo'    => $this->sexo,
        ];

        if ($this->mascotaId) {
            $m = Mascota::find($this->mascotaId);
            abort_unless($m->user_id === Auth::id(), 403);
            $m->update($data);
            session()->flash('message', 'Mascota actualizada.');
        } else {
            Auth::user()->mascotas()->create($data);
            session()->flash('message', 'Mascota creada.');
        }

        // refrescar listado correctamente en Livewire v3
        $this->dispatch('render')->to('persona.mascota-index');
        $this->dispatch('mascotaAgregada')->to('persona.mascota-index'); // <--- add this line

        // reset form
        $this->reset(['mascotaId','nombre','edad','especie','raza','sexo']);
    }
}
