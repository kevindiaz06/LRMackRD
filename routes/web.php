<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resources([
        'categorias' => CategoriaController::class,
        'proveedores' => ProveedorController::class,
        'libros' => LibroController::class,
        'clientes' => ClienteController::class,
        'empleados' => EmpleadoController::class,
        'ventas' => VentaController::class,
        'pagos' => PagoController::class,
        'inventarios' => InventarioController::class,
        'facturas' => FacturaController::class,
    ]);

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/ventas-diarias', [ReporteController::class, 'ventasDiarias'])->name('reportes.ventas-diarias');
    Route::get('/reportes/ventas-mensuales', [ReporteController::class, 'ventasMensuales'])->name('reportes.ventas-mensuales');
    Route::get('/reportes/inventario-actual', [ReporteController::class, 'inventarioActual'])->name('reportes.inventario-actual');
    Route::get('/reportes/libros-populares', [ReporteController::class, 'librosPopulares'])->name('reportes.libros-populares');
    Route::get('/reportes/rendimiento-empleados', [ReporteController::class, 'rendimientoEmpleados'])->name('reportes.rendimiento-empleados');
});
