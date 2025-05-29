<div>
  <h2 class="text-xl font-semibold mb-4">Mi Carrito</h2>

  @if(empty($carrito))
    <p>No hay productos en el carrito.</p>
  @else
    <table class="w-full table-auto mb-4">
      <thead>
        <tr>
          <th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($carrito as $id => $item)
          <tr>
            <td class="flex items-center space-x-2">
              @if($item['imagen'])
                <img src="{{ Storage::url($item['imagen']) }}" class="h-12 w-12 object-cover rounded">
              @endif
              <span>{{ $item['nombre'] }}</span>
            </td>
            <td>
              <div class="flex items-center">
                <button wire:click="modificarCantidad({{ $id }}, -1)" class="px-2">–</button>
                <span class="px-2">{{ $item['cantidad'] }}</span>
                <button wire:click="modificarCantidad({{ $id }}, 1)" class="px-2">+</button>
              </div>
            </td>
            <td>${{ number_format($item['precio'],2) }}</td>
            <td>${{ number_format($item['precio'] * $item['cantidad'],2) }}</td>
            <td>
              <button wire:click="quitar({{ $id }})"
                      class="text-red-600 hover:underline">Eliminar</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="flex justify-between items-center mb-4">
      <p class="text-lg font-semibold">Total: ${{ number_format($this->total,2) }}</p>
      <!-- Aquí irá el botón de PayPal -->
      <div id="paypal-button-container"></div>
    </div>
  @endif
</div>

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=MXN"></script>
<script>
  document.addEventListener('livewire:load', function () {
    if (document.getElementById('paypal-button-container')) {
      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: { value: '{{ number_format($this->total,2, '.', '') }}' }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            // Aquí puedes disparar un evento Livewire para procesar el pago
            Livewire.emit('pagoExitoso', details.id);
          });
        }
      }).render('#paypal-button-container');
    }
  });
</script>
@endpush
