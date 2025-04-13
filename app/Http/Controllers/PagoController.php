<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::with('venta.cliente')->paginate(10);
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = Venta::with('cliente')->get();
        return view('pagos.create', compact('ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo' => 'required|string|in:Efectivo,Tarjeta,Transferencia',
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        $pago->load('venta.cliente');
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        $ventas = Venta::with('cliente')->get();
        return view('pagos.edit', compact('pago', 'ventas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo' => 'required|string|in:Efectivo,Tarjeta,Transferencia',
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos.index')
            ->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        try {
            $pago->delete();
            return redirect()->route('pagos.index')
                ->with('success', 'Pago eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')
                ->with('error', 'No se puede eliminar este pago.');
        }
    }
}
