<div>
  <h2 class="text-xl font-semibold mb-4">Mis Horarios</h2>

  @if(session()->has('message'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <button wire:click="$dispatch('editHorario', null)"
          class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
    + Nuevo Horario
  </button>

  <table class="w-full table-auto">
    <thead>
      <tr>
        <th>Fecha</th><th>Inicio</th><th>Fin</th><th>Duración</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($horarios as $h)
      <tr>
        <td>{{ \Carbon\Carbon::parse($h->fecha)->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') }}</td>
        <td>{{ \Carbon\Carbon::parse($h->hora_fin)->format('H:i') }}</td>
        <td>{{ $h->duracion_minutos }} min</td>
        <td>
          <button wire:click="$dispatch('editHorario', {{ $h->id }})"
                  class="text-blue-600">Editar</button>
          <button wire:click="confirmDelete({{ $h->id }})"
                  class="text-red-600">Eliminar</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @if($confirmingDeletion)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded">
        <p>¿Seguro que deseas eliminar este horario?</p>
        <button wire:click="deleteHorario"
                class="bg-red-500 text-white px-4 py-2 rounded">Sí, eliminar</button>
        <button wire:click="$set('confirmingDeletion', false)"
                class="ml-2 px-4 py-2">Cancelar</button>
      </div>
    </div>
  @endif
</div>

