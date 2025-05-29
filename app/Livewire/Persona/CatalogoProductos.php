<?php

namespace App\Livewire\Persona;

use Livewire\Component;
use App\Models\Producto;

class CatalogoProductos extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::all();
    }

    public function agregarAlCarrito($id)
    {
        // obtener carrito actual de sesión
        $carrito = session()->get('carrito', []);

        // si ya existe el producto en carrito, incrementar cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $producto = Producto::findOrFail($id);
            $carrito[$id] = [
                'nombre'  => $producto->nombre,
                'precio'  => $producto->precio,
                'imagen'  => $producto->imagen,
                'cantidad'=> 1,
            ];
        }

        session()->put('carrito', $carrito);
        $this->emit('carritoActualizado');
        session()->flash('message', 'Producto agregado al carrito.');
    }

    public function render()
    {
        return view('livewire.persona.catalogo-productos');
    }
}
