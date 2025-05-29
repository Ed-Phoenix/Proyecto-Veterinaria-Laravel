@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-md">
  <h1 class="text-xl font-semibold mb-4">Nuevo Veterinario</h1>
  <form action="{{ route('admin.veterinarios.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label>Nombre</label>
      <input name="name" value="{{ old('name') }}"
             class="w-full border p-2 rounded" required>
      @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Email</label>
      <input name="email" type="email" value="{{ old('email') }}"
             class="w-full border p-2 rounded" required>
      @error('email')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Contraseña</label>
      <input name="password" type="password"
             class="w-full border p-2 rounded" required>
      @error('password')<span class="text-red-600">{{ $message }}</span>@enderror
    </div>
    <div>
      <label>Confirmar Contraseña</label>
      <input name="password_confirmation" type="password"
             class="w-full border p-2 rounded" required>
    </div>
    <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded">Crear</button>
  </form>
</div>
@endsection
