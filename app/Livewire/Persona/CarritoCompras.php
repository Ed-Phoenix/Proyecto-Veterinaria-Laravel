<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CarritoCompras extends Component
{
     public $carrito;

    protected $listeners = [
        'carritoActualizado' => 'mount',
        'pagoExitoso'        => 'procesarPago',
    ];

    public function mount()
    {
        $this->carrito = session()->get('carrito', []);
    }

    public function quitar($id)
    {
        $carrito = session()->get('carrito', []);
        unset($carrito[$id]);
        session()->put('carrito', $carrito);
        $this->mount();
    }

    public function modificarCantidad($id, $delta)
    {
        $carrito = session()->get('carrito', []);
        if (!isset($carrito[$id])) return;
        $carrito[$id]['cantidad'] = max(1, $carrito[$id]['cantidad'] + $delta);
        session()->put('carrito', $carrito);
        $this->mount();
    }

    public function procesarPago($paypalOrderId)
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            session()->flash('message', 'Carrito vacío.');
            return;
        }

        // 1. Crear la orden
        $total = $this->total;
        $order = Order::create([
            'user_id'        => Auth::id(),
            'paypal_order_id'=> $paypalOrderId,
            'total'          => $total,
            'status'         => 'paid',
        ]);

        // 2. Crear items
        foreach ($carrito as $productoId => $item) {
            OrderItem::create([
                'order_id'       => $order->id,
                'producto_id'    => $productoId,
                'cantidad'       => $item['cantidad'],
                'precio_unitario'=> $item['precio'],
                'subtotal'       => $item['precio'] * $item['cantidad'],
            ]);
        }

        // 3. Vaciar carrito
        session()->forget('carrito');
        $this->mount();

        // 4. Enviar correo de confirmación
        Mail::to(Auth::user()->email)
            ->send(new OrderConfirmation($order));

        session()->flash('message', 'Pago exitoso. Tu orden fue registrada.');
    }

    public function getTotalProperty()
    {
        return array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $this->carrito));
    }

    public function render()
    {
        return view('livewire.persona.carrito-compras');
    }
}
