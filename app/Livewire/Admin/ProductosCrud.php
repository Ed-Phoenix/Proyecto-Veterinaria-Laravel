<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Producto;
use Livewire\WithFileUploads;

class ProductosCrud extends Component
{
    use WithFileUploads;

    public $nombre, $descripcion, $precio, $imagen, $productoId;
    public $modoEdicion = false;

    protected $rules = [
        'nombre' => 'required|string',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $productos = Producto::all();
        return view('livewire.admin.productos-crud', compact('productos'));
    }

    public function guardar()
    {
        $this->validate();

        $producto = new Producto();
        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;
        $producto->precio = $this->precio;

        if ($this->imagen) {
            $producto->imagen = $this->imagen->store('productos', 'public');
        }

        $producto->save();
        $this->limpiar();
    }

    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $this->productoId = $id;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->modoEdicion = true;
    }

    public function actualizar()
    {
        $this->validate();

        $producto = Producto::findOrFail($this->productoId);
        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;
        $producto->precio = $this->precio;

        if ($this->imagen) {
            $producto->imagen = $this->imagen->store('productos', 'public');
        }

        $producto->save();
        $this->limpiar();
    }

    public function eliminar($id)
    {
        Producto::destroy($id);
    }

    public function limpiar()
    {
        $this->reset(['nombre', 'descripcion', 'precio', 'imagen', 'productoId', 'modoEdicion']);
    }
}
