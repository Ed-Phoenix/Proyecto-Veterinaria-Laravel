<div class="mb-6 p-4 border rounded">
  <h3 class="text-lg font-medium mb-2">
    {{ $horarioId ? 'Editar Horario' : 'Nuevo Horario' }}
  </h3>

  @if(session()->has('message'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <form wire:submit.prevent="save" class="space-y-4">
    <div>
      <label>Fecha</label>
      <input wire:model="fecha" type="date" class="w-full border p-2 rounded">
      @error('fecha') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div class="flex space-x-4">
      <div class="flex-1">
        <label>Hora Inicio</label>
        <input wire:model="hora_inicio" type="time" class="w-full border p-2 rounded">
        @error('hora_inicio') <span class="text-red-600">{{ $message }}</span> @enderror
      </div>
      <div class="flex-1">
        <label>Hora Fin</label>
        <input wire:model="hora_fin" type="time" class="w-full border p-2 rounded">
        @error('hora_fin') <span class="text-red-600">{{ $message }}</span> @enderror
      </div>
    </div>
    <div>
      <label>Duración (minutos)</label>
      <input wire:model.defer="duracion_minutos" type="number"
             class="w-1/3 border p-2 rounded">
      @error('duracion_minutos') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded">
      {{ $horarioId ? 'Actualizar' : 'Guardar' }}
    </button>
  </form>
</div>
