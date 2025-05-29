<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte Cita #{{ $cita->id }}</title>
  <style>
    body { font-family: sans-serif; }
    h1 { text-align: center; }
    .section { margin-bottom: 1.5rem; }
    .label { font-weight: bold; }
  </style>
</head>
<body>
  <h1>Reporte de Cita #{{ $cita->id }}</h1>

  <div class="section">
    <p><span class="label">Fecha:</span> {{ $cita->horario->fecha->format('d/m/Y') }}</p>
    <p><span class="label">Hora:</span> {{ \Carbon\Carbon::parse($cita->horario->hora_inicio)->format('H:i') }}</p>
    <p><span class="label">Paciente:</span> {{ $cita->persona->name }}</p>
    <p><span class="label">Mascota:</span> {{ $cita->mascota->nombre }}</p>
  </div>

  <div class="section">
    <p><span class="label">Anotaciones:</span></p>
    <div style="white-space: pre-wrap;">{{ $nota->contenido ?? '— Sin anotaciones —' }}</div>
  </div>
</body>
</html>
