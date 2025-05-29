<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class MascotaIndex extends Component
{
    public $confirmingDeletion = false;
    public $deleteId = null;

    protected $listeners = ['mascotaAgregada' => '$refresh'];

    public function render()
    {
        $mascotas = Auth::user()->mascotas()->latest()->get();
        return view('livewire.persona.mascota-index', compact('mascotas'));
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletion = true;
        $this->deleteId = $id;
    }

    public function deleteMascota()
    {
        Mascota::findOrFail($this->deleteId)->delete();
        $this->confirmingDeletion = false;
        session()->flash('message', 'Mascota eliminada correctamente.');
    }
}
