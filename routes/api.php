<?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\FacturaController;
use App\Http\Controllers\Api\InventarioController;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\VentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de API
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('libros', LibroController::class);
Route::apiResource('clientes', ClienteController::class);
Route::apiResource('empleados', EmpleadoController::class);
Route::apiResource('ventas', VentaController::class);
Route::apiResource('pagos', PagoController::class);
Route::apiResource('inventarios', InventarioController::class);
Route::apiResource('facturas', FacturaController::class);
