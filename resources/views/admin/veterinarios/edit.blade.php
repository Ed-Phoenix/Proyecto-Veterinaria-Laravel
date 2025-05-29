@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-md">
  <h1 class="text-xl font-semibold mb-4">Editar Veterinario</h1>
  <form action="{{ route('admin.veterinarios.update', $veterinario) }}"
        method="POST" class="space-y-4">
    @csrf @method('PUT')
    <div>
      <label>Nombre</label>
      <input name="name" value="{{ old('name', $veterinario->name) }}"
             class="w-full border p-2 rounded" required>
      @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Email</label>
      <input name="email" type="email"
             value="{{ old('email', $veterinario->email) }}"
             class="w-full border p-2 rounded" required>
      @error('email')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Nueva Contraseña (opcional)</label>
      <input name="password" type="password"
             class="w-full border p-2 rounded">
      @error('password')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Confirmar Contraseña</label>
      <input name="password_confirmation" type="password"
             class="w-full border p-2 rounded">
    </div>
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
  </form>
</div>
@endsection
