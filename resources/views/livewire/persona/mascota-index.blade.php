<div>
    <h2 class="text-xl font-semibold mb-4">Mis Mascotas</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="$dispatch('editMascota', [null])"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
      + Nueva Mascota
    </button>

    <table class="w-full table-auto">
      <thead>
        <tr>
          <th>Nombre</th><th>Edad</th><th>Especie</th><th>Raza</th><th>Sexo</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($mascotas as $m)
        <tr>
          <td>{{ $m->nombre }}</td>
          <td>{{ $m->edad }} años</td>
          <td>{{ $m->especie }}</td>
          <td>{{ $m->raza }}</td>
          <td>{{ $m->sexo }}</td>
          <td>
            <button wire:click="$dispatch('editMascota', [{{ $m->id }}])"
                    class="text-blue-600">Editar</button>
            <button wire:click="confirmDelete({{ $m->id }})"
                    class="text-red-600">Eliminar</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Modal de confirmación --}}
    @if($confirmingDeletion)
      <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded">
          <p>¿Seguro que deseas eliminar esta mascota?</p>
          <button wire:click="deleteMascota" class="bg-red-500 text-white px-4 py-2 rounded">Sí, eliminar</button>
          <button wire:click="$set('confirmingDeletion', false)" class="ml-2 px-4 py-2">Cancelar</button>
        </div>
      </div>
    @endif
</div>