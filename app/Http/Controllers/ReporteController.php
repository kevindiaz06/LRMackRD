<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\Libro;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function ventasDiarias()
    {
        $ventasHoy = Venta::with(['cliente', 'empleado', 'detalles.libro'])
            ->whereDate('fecha', Carbon::today())
            ->latest()
            ->get();

        $totalVentas = $ventasHoy->sum('total');
        $cantidadVentas = $ventasHoy->count();

        return view('reportes.ventas-diarias', compact('ventasHoy', 'totalVentas', 'cantidadVentas'));
    }

    public function ventasMensuales()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $ventasPorDia = Venta::selectRaw('DATE(fecha) as fecha, SUM(total) as total_ventas, COUNT(*) as cantidad_ventas')
            ->whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $totalMes = $ventasPorDia->sum('total_ventas');
        $cantidadVentasMes = $ventasPorDia->sum('cantidad_ventas');

        return view('reportes.ventas-mensuales', compact('ventasPorDia', 'totalMes', 'cantidadVentasMes', 'mesActual'));
    }

    public function inventarioActual()
    {
        $inventarios = Inventario::with('libro.categoria')
            ->get()
            ->sortBy('libro.categoria.nombre');

        $totalLibros = $inventarios->sum('cantidad');
        $categoriasInventario = $inventarios->groupBy('libro.categoria.nombre')
            ->map(function ($items) {
                return [
                    'cantidad' => $items->sum('cantidad'),
                    'valor' => $items->sum(function ($item) {
                        return $item->cantidad * $item->libro->precio;
                    })
                ];
            });

        return view('reportes.inventario-actual', compact('inventarios', 'totalLibros', 'categoriasInventario'));
    }

    public function librosPopulares()
    {
        $librosPopulares = DetalleVenta::select('libro_id', DB::raw('SUM(cantidad) as total_vendidos'))
            ->with('libro.categoria')
            ->groupBy('libro_id')
            ->orderByDesc('total_vendidos')
            ->take(10)
            ->get();

        $categoriasMasVendidas = DetalleVenta::join('libros', 'detalle_ventas.libro_id', '=', 'libros.id')
            ->join('categorias', 'libros.categoria_id', '=', 'categorias.id')
            ->select('categorias.nombre', DB::raw('SUM(detalle_ventas.cantidad) as total_vendidos'))
            ->groupBy('categorias.nombre')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->get();

        return view('reportes.libros-populares', compact('librosPopulares', 'categoriasMasVendidas'));
    }

    public function rendimientoEmpleados()
    {
        $rendimientoEmpleados = Empleado::withCount(['ventas'])
            ->withSum('ventas', 'total')
            ->orderByDesc('ventas_sum_total')
            ->get();

        $mejorVendedor = $rendimientoEmpleados->first();
        $peorVendedor = $rendimientoEmpleados->last();

        $totalVentas = $rendimientoEmpleados->sum('ventas_sum_total');

        return view('reportes.rendimiento-empleados', compact('rendimientoEmpleados', 'mejorVendedor', 'peorVendedor', 'totalVentas'));
    }
}
