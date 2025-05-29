@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-xl">
  <h1 class="text-xl font-semibold mb-4">Anotaciones para cita #{{ $cita->id }}</h1>

  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="" method="POST" class="space-y-4">
    @csrf
    <div>
      <label>Notas</label>
      <textarea name="contenido" rows="8"
                class="w-full border p-2 rounded"
                required>{{ old('contenido', $cita->nota->contenido ?? '') }}</textarea>
      @error('contenido')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div class="flex space-x-2">
      <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded">
        Guardar Anotación
      </button>
      <a href="{{ route('vet.citas.reporte', $cita) }}"
         class="bg-green-600 text-white px-4 py-2 rounded">
        Generar PDF
      </a>
    </div>
  </form>
</div>
@endsection
