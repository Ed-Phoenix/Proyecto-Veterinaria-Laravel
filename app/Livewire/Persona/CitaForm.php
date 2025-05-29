<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Cita;
use App\Models\Mascota;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaCita;

class CitaForm extends Component
{
    public $mascota_id, $veterinario_id, $asunto, $descripcion, $fecha;
    public $horario_id;
    public $horariosDisponibles = [];

    protected $rules = [
        'mascota_id'      => 'required|exists:mascotas,id',
        'veterinario_id'  => 'required|exists:users,id',
        'asunto'          => 'required|string|max:100',
        'descripcion'     => 'nullable|string',
        'fecha'           => 'required|date',
        'horario_id'      => 'required|exists:horarios,id',
    ];

    // Carga mascotas y vets al montar
    public function mount()
    {
        $this->mascotas = Auth::user()->mascotas;
        $this->veterinarios = \Spatie\Permission\Models\Role::findByName('veterinario')
                                 ->users;
    }

    // Cuando elige una fecha y vet, recarga franjas
    public function updatedVeterinarioId($vetId)
    {
        $this->loadHorarios();
    }
    public function updatedFecha($fecha)
    {
        $this->loadHorarios();
    }

    public function loadHorarios()
    {
        if ($this->veterinario_id && $this->fecha) {
            $this->horariosDisponibles = Horario::where('user_id', $this->veterinario_id)
                ->where('fecha', $this->fecha)
                ->whereNotIn('id', Cita::pluck('horario_id'))
                ->get();
        } else {
            $this->horariosDisponibles = collect();
        }
        $this->horario_id = null; // reset selección
    }

    public function save()
    {
        $this->validate();

        $cita = Cita::create([
          'user_id'        => Auth::id(),
          'mascota_id'     => $this->mascota_id,
          'veterinario_id' => $this->veterinario_id,
          'horario_id'     => $this->horario_id,
          'asunto'         => $this->asunto,
          'descripcion'    => $this->descripcion,
        ]);

        // enviar correo al vet
        Mail::to($cita->veterinario->email)
            ->send(new NuevaCita($cita));

        session()->flash('message', 'Cita agendada, pendiente de confirmación.');

        // reset form
        $this->reset('mascota_id','veterinario_id','asunto','descripcion','fecha','horario_id','horariosDisponibles');
        $this->dispatch('render')->to('persona.cita-index');
        $this->dispatch('citaAgendada')->to('persona.cita-index'); // <-- agrega este evento
    }

    public function render()
    {
        return view('livewire.persona.cita-form', [
          'mascotas'      => Auth::user()->mascotas,
          'veterinarios'  => \Spatie\Permission\Models\Role::findByName('veterinario')->users,
        ]);
    }
}
