<?php

namespace App\Http\Controllers\Vet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Nota;
use PDF;

class CitaVetController extends Controller
{
    public function confirmar(Cita $cita)
    {
        abort_unless($cita->veterinario_id === auth()->id(), 403);
        $cita->update(['estado' => 'confirmada']);
        return back()->with('success', 'Cita confirmada.');
    }

    public function showAnotaciones(Cita $cita)
{
    abort_unless($cita->veterinario_id === auth()->id(), 403);
    return view('vet.citas.anotaciones', compact('cita'));
}

public function guardarAnotacion(Request $request, Cita $cita)
{
    abort_unless($cita->veterinario_id === auth()->id(), 403);
    $data = $request->validate([
        'contenido' => 'required|string',
    ]);
    Nota::updateOrCreate(
        ['cita_id' => $cita->id],
        ['contenido' => $data['contenido']]
    );
    return back()->with('success', 'Anotación guardada.');
}

public function generarReporte(Cita $cita)
{
    abort_unless($cita->veterinario_id === auth()->id(), 403);
    $nota = $cita->nota;
    $pdf = PDF::loadView('vet.citas.reporte', compact('cita','nota'));
    return $pdf->download("reporte_cita_{$cita->id}.pdf");
}
}
