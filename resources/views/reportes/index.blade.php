@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Reportes
    </h2>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
        <!-- Ventas Diarias -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Ventas Diarias</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Visualiza las ventas del día actual con detalles de productos vendidos y montos.</p>
                <a href="{{ route('reportes.ventas-diarias') }}" class="btn-primary w-full text-center">Ver Reporte</a>
            </div>
        </div>

        <!-- Ventas Mensuales -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Ventas Mensuales</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Analiza las tendencias de ventas del mes actual con gráficos y estadísticas.</p>
                <a href="{{ route('reportes.ventas-mensuales') }}" class="btn-primary w-full text-center">Ver Reporte</a>
            </div>
        </div>

        <!-- Inventario Actual -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Inventario Actual</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Consulta el estado actual del inventario, stock disponible y productos agotados.</p>
                <a href="{{ route('reportes.inventario-actual') }}" class="btn-primary w-full text-center">Ver Reporte</a>
            </div>
        </div>

        <!-- Libros Populares -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Libros Populares</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Descubre cuáles son los libros más vendidos y sus categorías más populares.</p>
                <a href="{{ route('reportes.libros-populares') }}" class="btn-primary w-full text-center">Ver Reporte</a>
            </div>
        </div>

        <!-- Rendimiento de Empleados -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Rendimiento de Empleados</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Evalúa el desempeño de tus empleados basado en ventas y atención al cliente.</p>
                <a href="{{ route('reportes.rendimiento-empleados') }}" class="btn-primary w-full text-center">Ver Reporte</a>
            </div>
        </div>
    </div>
@endsection
