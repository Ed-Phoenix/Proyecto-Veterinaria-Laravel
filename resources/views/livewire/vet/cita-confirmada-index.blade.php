<div>
  <h2 class="text-xl font-semibold mb-4">Próximas Citas</h2>
  <table class="w-full table-auto">
    <thead>
      <tr>
        <th>Fecha</th><th>Hora</th><th>Paciente</th><th>Mascota</th><th>Asunto</th><th>Notas</th>
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
          <a href="{{ route('vet.citas.anotaciones', $c) }}"
             class="bg-blue-500 text-white px-3 py-1 rounded">
            Anotaciones
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
