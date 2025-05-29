@extends('layouts.app')

@section('content')
  <div class="container mx-auto py-6">
    @if (session()->has('message'))
      <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('message') }}
      </div>
    @endif

    <livewire:persona.carrito-compras />
  </div>
@endsection
