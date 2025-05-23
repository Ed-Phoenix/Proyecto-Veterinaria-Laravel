<div class="max-w-4xl mx-auto mt-10 p-4 bg-white rounded-xl shadow">
    @if (session()->has('mensaje'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $modo_edicion ? 'actualizar' : 'guardar' }}" class="grid grid-cols-2 gap-4">
        <input wire:model="nombre" type="text" placeholder="Nombre" class="input input-bordered" required>
        <input wire:model="edad" type="number" placeholder="Edad" class="input input-bordered" required>
        <input wire:model="especie" type="text" placeholder="Especie" class="input input-bordered" required>
        <input wire:model="raza" type="text" placeholder="Raza" class="input input-bordered" required>
        <select wire:model="sexo" class="input input-bordered" required>
            <option value="">Sexo</option>
            <option value="macho">Macho</option>
            <option value="hembra">Hembra</option>
        </select>

        <div class="col-span-2 flex gap-2">
            <button type="submit" class="btn btn-primary">
                {{ $modo_edicion ? 'Actualizar' : 'Guardar' }}
            </button>
            @if ($modo_edicion)
                <button type="button" wire:click="resetCampos" class="btn btn-secondary">Cancelar</button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-4">Mis mascotas</h2>
    <div class="space-y-4">
        @foreach($mascotas as $mascota)
            <div class="p-4 border rounded flex justify-between items-center">
                <div>
                    <p><strong>{{ $mascota->nombre }}</strong> ({{ $mascota->especie }}, {{ $mascota->raza }})</p>
                    <p>Edad: {{ $mascota->edad }} años - Sexo: {{ ucfirst($mascota->sexo) }}</p>
                </div>
                <div class="space-x-2">
                    <button wire:click="editar({{ $mascota->id }})" class="btn btn-sm btn-warning">Editar</button>
                    <button wire:click="eliminar({{ $mascota->id }})" class="btn btn-sm btn-error">Eliminar</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
