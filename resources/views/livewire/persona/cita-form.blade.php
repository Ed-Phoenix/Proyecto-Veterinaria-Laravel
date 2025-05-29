<div class="p-4 border rounded mb-6">
  <h3 class="text-lg mb-4">Agendar Nueva Cita</h3>

  @if (session()->has('message'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <form wire:submit.prevent="save" class="space-y-4">
    <div>
      <label>Mascota</label>
      <select wire:model="mascota_id" class="w-full border p-2 rounded">
        <option value="">-- Selecciona --</option>
        @foreach($mascotas as $m)
          <option value="{{ $m->id }}">{{ $m->nombre }} ({{ $m->especie }})</option>
        @endforeach
      </select>
      @error('mascota_id') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Veterinario</label>
      <select wire:model="veterinario_id" class="w-full border p-2 rounded">
        <option value="">-- Selecciona --</option>
        @foreach($veterinarios as $v)
          <option value="{{ $v->id }}">{{ $v->name }}</option>
        @endforeach
      </select>
      @error('veterinario_id') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Fecha</label>
      <input wire:model="fecha" type="date" class="border p-2 rounded">
      @error('fecha') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    @if(count($horariosDisponibles))
      <div>
        <label>Horarios disponibles</label>
        <select wire:model="horario_id" class="w-full border p-2 rounded">
          <option value="">-- Selecciona --</option>
          @foreach($horariosDisponibles as $h)
            <option value="{{ $h->id }}">
              {{ \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') }}—
              {{ \Carbon\Carbon::parse($h->hora_fin)->format('H:i') }}
            </option>
          @endforeach
        </select>
        @error('horario_id') <span class="text-red-600">{{ $message }}</span> @enderror
      </div>
    @endif

    <div>
      <label>Asunto</label>
      <input wire:model.defer="asunto" type="text" class="w-full border p-2 rounded">
      @error('asunto') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Descripción</label>
      <textarea wire:model.defer="descripcion" class="w-full border p-2 rounded"></textarea>
      @error('descripcion') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
      Agendar
    </button>
  </form>
</div>

