<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <livewire:styles />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <nav class="space-x-4">
              @role('persona')
                <a href="{{ route('mascotas.index') }}" class="hover:underline">Mis Mascotas</a>
                <a href="{{ route('citas.index') }}"    class="hover:underline">Mis Citas</a>
                <a href="{{ route('tienda.index') }}"   class="hover:underline">Tienda</a>
                <a href="{{ route('carrito.index') }}"  class="hover:underline">Carrito</a>
              @endrole

              @role('veterinario')
                <a href="{{ route('horarios.index') }}" class="hover:underline">Mis Horarios</a>
                <a href="{{ route('citas.vet') }}"      class="hover:underline">Citas Pendientes</a>
              @endrole

              @role('admin')
                <a href="{{ route('veterinarios.index') }}" class="hover:underline">Veterinarios</a>
                <a href="{{ route('productos.index') }}"     class="hover:underline">Productos</a>
              @endrole
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <livewire:scripts />
    </body>
</html>
