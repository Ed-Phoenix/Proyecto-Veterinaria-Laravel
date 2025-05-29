<div class="p-6 space-y-6">

    {{-- FORMULARIO DE CREACIÓN / EDICIÓN --}}
    <form wire:submit.prevent="{{ $modoEdicion ? 'actualizar' : 'guardar' }}" class="space-y-4">
        <h2 class="text-xl font-bold">{{ $modoEdicion ? 'Editar Producto' : 'Nuevo Producto' }}</h2>

        <div>
            <label class="block mb-1 font-semibold">Nombre</label>
            <input type="text" wire:model="nombre" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Descripción</label>
            <textarea wire:model="descripcion" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Precio</label>
            <input type="number" wire:model="precio" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Imagen</label>
            <input type="file" wire:model="imagen" class="w-full">
            @error('imagen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($imagen)
                <p class="mt-2">Vista previa:</p>
                <img src="{{ $imagen->temporaryUrl() }}" class="h-24 mt-2 rounded shadow">
            @endif
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                {{ $modoEdicion ? 'Actualizar' : 'Guardar' }}
            </button>

            @if ($modoEdicion)
                <button type="button" wire:click="limpiar" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancelar
                </button>
            @endif
        </div>
    </form>

    <hr>

    {{-- LISTA DE PRODUCTOS --}}
    <h2 class="text-xl font-bold mt-6">Lista de Productos</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($productos as $producto)
            <div class="border border-gray-300 rounded shadow p-4 relative">
                @if ($producto->imagen)
                    <img src="{{ Storage::url($producto->imagen) }}" class="w-full h-40 object-cover rounded mb-3">
                @endif
                <h3 class="text-lg font-semibold">{{ $producto->nombre }}</h3>
