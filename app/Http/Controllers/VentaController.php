<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Libro;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['cliente', 'empleado'])->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $libros = Libro::where('stock', '>', 0)->get();
        return view('ventas.create', compact('clientes', 'empleados', 'libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'libros' => 'required|array|min:1',
            'libros.*.id' => 'required|exists:libros,id',
            'libros.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Crear la venta
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'empleado_id' => $request->empleado_id,
                'fecha' => $request->fecha,
                'total' => 0,
            ]);

            $total = 0;

            // Crear los detalles de la venta
            foreach ($request->libros as $item) {
                $libro = Libro::findOrFail($item['id']);

                if ($libro->stock < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para el libro: {$libro->titulo}");
                }

                $subtotal = $libro->precio * $item['cantidad'];
                $total += $subtotal;

                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'libro_id' => $libro->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $libro->precio,
                    'subtotal' => $subtotal,
                ]);

                // Actualizar stock
                $libro->update([
                    'stock' => $libro->stock - $item['cantidad']
                ]);
            }

            // Actualizar el total de la venta
            $venta->update(['total' => $total]);

            DB::commit();

            return redirect()->route('ventas.index')
                ->with('success', 'Venta creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al crear la venta: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load(['cliente', 'empleado', 'detalles.libro']);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        // No se recomienda editar ventas una vez creadas
        return redirect()->route('ventas.show', $venta)
            ->with('error', 'No se pueden editar ventas una vez creadas.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        // No se recomienda actualizar ventas una vez creadas
        return redirect()->route('ventas.show', $venta)
            ->with('error', 'No se pueden actualizar ventas una vez creadas.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        // No se recomienda eliminar ventas una vez creadas
        return redirect()->route('ventas.index')
            ->with('error', 'No se pueden eliminar ventas una vez creadas.');
    }
}
