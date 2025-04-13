<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::with('libro')->paginate(10);
        return view('inventarios.index', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
        return view('inventarios.create', compact('libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'cantidad' => 'required|integer',
            'tipo_movimiento' => 'required|in:entrada,salida',
            'fecha' => 'required|date',
            'notas' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Crear el registro de inventario
            $inventario = Inventario::create($request->all());

            // Actualizar el stock del libro
            $libro = Libro::findOrFail($request->libro_id);

            if ($request->tipo_movimiento == 'entrada') {
                $libro->stock += $request->cantidad;
            } else {
                if ($libro->stock < $request->cantidad) {
                    throw new \Exception('No hay suficiente stock disponible.');
                }
                $libro->stock -= $request->cantidad;
            }

            $libro->save();

            DB::commit();

            return redirect()->route('inventarios.index')
                ->with('success', 'Movimiento de inventario registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al registrar movimiento: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        $inventario->load('libro');
        return view('inventarios.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        // No se recomienda editar movimientos de inventario una vez creados
        return redirect()->route('inventarios.show', $inventario)
            ->with('error', 'No se pueden editar movimientos de inventario una vez creados.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        // No se recomienda actualizar movimientos de inventario una vez creados
        return redirect()->route('inventarios.show', $inventario)
            ->with('error', 'No se pueden actualizar movimientos de inventario una vez creados.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        // No se recomienda eliminar movimientos de inventario una vez creados
        return redirect()->route('inventarios.index')
            ->with('error', 'No se pueden eliminar movimientos de inventario una vez creados.');
    }
}
