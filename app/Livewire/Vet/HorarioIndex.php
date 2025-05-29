<?php

namespace App\Livewire\Vet;

use Livewire\Component;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;

class HorarioIndex extends Component
{
    public $confirmingDeletion = false;
    public $deleteId = null;

    public function render()
    {
        $horarios = Auth::user()
            ->horarios()
            ->orderBy('fecha','desc')
            ->orderBy('hora_inicio')
            ->get();

        return view('livewire.vet.horario-index', compact('horarios'));
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletion = true;
        $this->deleteId = $id;
    }

    public function deleteHorario()
    {
        Horario::findOrFail($this->deleteId)->delete();
        $this->confirmingDeletion = false;
        session()->flash('message', 'Horario eliminado correctamente.');
    }
}
