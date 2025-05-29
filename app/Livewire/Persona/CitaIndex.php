<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CitaIndex extends Component
{
    protected $listeners = ['citaAgendada' => '$refresh'];

    public function render()
    {
        $citas = Cita::with(['mascota','veterinario','horario'])
                     ->where('user_id', Auth::id())
                     ->latest()
                     ->get();

        return view('livewire.persona.cita-index', compact('citas'));
    }
}
