<?php

namespace App\Livewire\Vet;

use Livewire\Component;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CitaConfirmadaIndex extends Component
{
    public function render()
    {
        $citas = Cita::with(['mascota','persona'])
                     ->where('veterinario_id', Auth::id())
                     ->where('estado', 'confirmada')
                     ->latest()
                     ->get();

        return view('livewire.vet.cita-confirmada-index', compact('citas'));
    }
}
