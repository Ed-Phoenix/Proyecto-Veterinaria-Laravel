@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">Veterinarios</h1>
    <a href="{{ route('admin.veterinarios.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">+ Nuevo</a>
  </div>

  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <table class="w-full table-auto">
    <thead>
      <tr>
        <th>Nombre</th><th>Email</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($veterinarios as $vet)
      <tr>
        <td>{{ $vet->name }}</td>
        <td>{{ $vet->email }}</td>
        <td class="space-x-2">
          <a href="{{ route('admin.veterinarios.edit', $vet) }}"
             class="text-blue-600">Editar</a>
          <form action="{{ route('admin.veterinarios.destroy', $vet) }}"
                method="POST" class="inline"
                onsubmit="return confirm('¿Eliminar este veterinario?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">
    {{ $veterinarios->links() }}
  </div>
</div>
@endsection
