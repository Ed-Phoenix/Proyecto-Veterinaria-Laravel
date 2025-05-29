<?php

namespace App\Livewire\Vet;

use Livewire\Component;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;

class HorarioForm extends Component
{
     public $horarioId;
    public $fecha, $hora_inicio, $hora_fin, $duracion_minutos = 30;

    protected $listeners = ['editHorario' => 'loadHorario'];

    protected $rules = [
        'fecha'            => 'required|date',
        'hora_inicio'      => 'required|date_format:H:i',
        'hora_fin'         => 'required|date_format:H:i|after:hora_inicio',
        'duracion_minutos' => 'required|integer|min:5|max:240',
    ];

    public function render()
    {
        return view('livewire.vet.horario-form');
    }

    public function loadHorario($id = null)
    {
        if ($id) {
            $h = Horario::findOrFail($id);
            abort_unless($h->user_id === Auth::id(), 403);
            $this->horarioId       = $h->id;
            $this->fecha           = $h->fecha instanceof \Carbon\Carbon ? $h->fecha->format('Y-m-d') : $h->fecha;
            $this->hora_inicio     = $h->hora_inicio;
            $this->hora_fin        = $h->hora_fin;
            $this->duracion_minutos = $h->duracion_minutos;
        } else {
            $this->reset('horarioId','fecha','hora_inicio','hora_fin','duracion_minutos');
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
          'user_id'          => Auth::id(),
          'fecha'            => $this->fecha,
          'hora_inicio'      => $this->hora_inicio,
          'hora_fin'         => $this->hora_fin,
          'duracion_minutos' => $this->duracion_minutos,
        ];

        if ($this->horarioId) {
            $h = Horario::findOrFail($this->horarioId);
            $h->update($data);
            session()->flash('message', 'Horario actualizado.');
        } else {
            Horario::create($data);
            session()->flash('message', 'Horario creado.');
        }

        // refrescar listado y limpiar form
        $this->dispatch('render')->to('vet.horario-index');
        $this->reset('horarioId','fecha','hora_inicio','hora_fin','duracion_minutos');
    }
}
