@extends('layouts.app')

@section('content')
  <div class="container mx-auto py-6 max-w-lg">
    <h1 class="text-xl font-semibold mb-4">Citas del Veterinario</h1>
    <div class="space-y-4">
      <a href="{{ route('citas.pendientes.index') }}"
         class="block bg-yellow-500 text-white px-4 py-2 rounded text-center">
        Ver Citas Pendientes
      </a>
      <a href="{{ route('citas.confirmadas.index') }}"
         class="block bg-green-600 text-white px-4 py-2 rounded text-center">
        Ver Citas Confirmadas
      </a>
    </div>
  </div>
@endsection
