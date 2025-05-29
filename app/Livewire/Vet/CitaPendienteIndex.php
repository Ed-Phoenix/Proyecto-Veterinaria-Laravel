<?php

namespace App\Livewire\Vet;

use Livewire\Component;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CitaPendienteIndex extends Component
{
    public function render()
    {
        $citas = Cita::with(['mascota','persona'])
                     ->where('veterinario_id', Auth::id())
                     ->where('estado', 'pendiente')
                     ->latest()
                     ->get();

        return view('livewire.vet.cita-pendiente-index', compact('citas'));
    }
}
