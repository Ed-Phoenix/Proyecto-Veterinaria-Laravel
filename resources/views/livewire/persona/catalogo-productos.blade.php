<div>
  <h2 class="text-xl font-semibold mb-4">Catálogo de Productos</h2>

  @if (session()->has('message'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($this->productos as $producto)
      <div class="border rounded shadow p-4 flex flex-col">
        @if($producto->imagen)
          <img src="{{ Storage::url($producto->imagen) }}"
               class="h-40 object-cover mb-4 rounded">
        @endif
        <h3 class="text-lg font-semibold">{{ $producto->nombre }}</h3>
        <p class="text-gray-700 flex-grow">{{ Str::limit($producto->descripcion, 100) }}</p>
        <p class="text-blue-600 font-bold mt-2">${{ number_format($producto->precio,2) }}</p>
        <button wire:click="agregarAlCarrito({{ $producto->id }})"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">
          Agregar al carrito
        </button>
      </div>
    @endforeach
  </div>
</div>

