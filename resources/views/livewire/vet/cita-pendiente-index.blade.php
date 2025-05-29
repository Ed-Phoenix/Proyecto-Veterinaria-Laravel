<div>
  <h2 class="text-xl font-semibold mb-4">Citas Pendientes</h2>
  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <table class="w-full table-auto">
    <thead>
      <tr>
        <th>Fecha</th><th>Hora</th><th>Paciente</th><th>Mascota</th><th>Asunto</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($citas as $c)
      <tr>
        <td>{{ $c->horario->fecha->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($c->horario->hora_inicio)->format('H:i') }}</td>
        <td>{{ $c->persona->name }}</td>
        <td>{{ $c->mascota->nombre }}</td>
        <td>{{ $c->asunto }}</td>
        <td>
          <form action="{{ route('vet.citas.confirmar', $c) }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                    class="bg-green-600 text-white px-3 py-1 rounded">
              Confirmar
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
