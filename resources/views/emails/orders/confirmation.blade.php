@component('mail::message')
# ¡Gracias por tu compra!

Hola {{ $order->user->name }},

Tu orden **#{{ $order->id }}** ha sido procesada con éxito.  

**Total:** ${{ number_format($order->total,2) }}  

@component('mail::table')
| Producto        | Cantidad | Precio unitario | Subtotal  |
| --------------- |:--------:| ---------------:| ---------:|
@foreach($items as $item)
| {{ $item->producto->nombre }} | {{ $item->cantidad }} | ${{ number_format($item->precio_unitario,2) }} | ${{ number_format($item->subtotal,2) }} |
@endforeach
@endcomponent

Gracias por confiar en nosotros.  

Saludos,  
**Tu Veterinaria**
@endcomponent
