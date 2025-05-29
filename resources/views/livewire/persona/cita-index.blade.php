<div>
  <h2 class="text-xl font-semibold mb-4">Mis Citas</h2>
  <table class="w-full table-auto">
    <thead>
      <tr>
        <th>Fecha</th><th>Hora</th><th>Mascota</th><th>Veterinario</th><th>Asunto</th><th>Estado</th>
      </tr>
    </thead>
    <tbody>
      @foreach($citas as $c)
      <tr>
        <td>{{ \Carbon\Carbon::parse($c->horario->fecha)->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($c->horario->hora_inicio)->format('H:i') }}</td>
        <td>{{ $c->mascota->nombre }}</td>
        <td>{{ $c->veterinario->name }}</td>
        <td>{{ $c->asunto }}</td>
        <td>{{ ucfirst($c->estado) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
