<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Venta;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::with('venta.cliente')->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = Venta::with('cliente')
            ->whereDoesntHave('factura')
            ->get();
        return view('facturas.create', compact('ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venta_id' => 'required|exists:ventas,id|unique:facturas,venta_id',
            'numero' => 'required|string|max:20|unique:facturas',
            'fecha' => 'required|date',
            'total_impuestos' => 'required|numeric|min:0',
        ]);

        // Obtener la venta para calcular el total con impuestos
        $venta = Venta::findOrFail($request->venta_id);

        $factura = Factura::create([
            'venta_id' => $request->venta_id,
            'numero' => $request->numero,
            'fecha' => $request->fecha,
            'total_sin_impuestos' => $venta->total,
            'total_impuestos' => $request->total_impuestos,
            'total_con_impuestos' => $venta->total + $request->total_impuestos,
        ]);

        return redirect()->route('facturas.index')
            ->with('success', 'Factura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        $factura->load('venta.cliente', 'venta.detalles.libro');
        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        // No se recomienda editar facturas una vez creadas
        return redirect()->route('facturas.show', $factura)
            ->with('error', 'No se pueden editar facturas una vez creadas.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        // No se recomienda actualizar facturas una vez creadas
        return redirect()->route('facturas.show', $factura)
            ->with('error', 'No se pueden actualizar facturas una vez creadas.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        // No se recomienda eliminar facturas una vez creadas
        return redirect()->route('facturas.index')
            ->with('error', 'No se pueden eliminar facturas una vez creadas por motivos legales y de auditoría.');
    }
}
