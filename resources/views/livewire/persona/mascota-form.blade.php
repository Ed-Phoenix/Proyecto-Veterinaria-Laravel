<div class="mb-6 p-4 border rounded">
  <h3 class="text-lg font-medium mb-2">
    {{ $mascotaId ? 'Editar Mascota' : 'Nueva Mascota' }}
  </h3>

  @if (session()->has('message'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <form wire:submit.prevent="save" class="space-y-4">
    <div>
      <label>Nombre</label>
      <input wire:model.defer="nombre" type="text" class="w-full border p-2 rounded">
      @error('nombre') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Edad (años)</label>
      <input wire:model.defer="edad" type="number" class="w-1/3 border p-2 rounded">
      @error('edad') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Especie</label>
      <input wire:model.defer="especie" type="text" class="w-full border p-2 rounded">
      @error('especie') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Raza</label>
      <input wire:model.defer="raza" type="text" class="w-full border p-2 rounded">
      @error('raza') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div>
      <label>Sexo</label>
      <select wire:model.defer="sexo" class="w-1/3 border p-2 rounded">
        <option value="">--Selecciona--</option>
        <option value="M">Macho</option>
        <option value="F">Hembra</option>
      </select>
      @error('sexo') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
      {{ $mascotaId ? 'Actualizar' : 'Guardar' }}
    </button>
  </form>
</div>

