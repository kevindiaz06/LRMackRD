@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Dashboard
    </h2>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Total de libros
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ \App\Models\Libro::count() }}
                </p>
            </div>
        </div>

        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Ventas hoy
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ \App\Models\Venta::whereDate('fecha', today())->count() }}
                </p>
            </div>
        </div>

        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Clientes
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ \App\Models\Cliente::count() }}
                </p>
            </div>
        </div>

        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Empleados
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ \App\Models\Empleado::count() }}
                </p>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-md">
            <h4 class="mb-4 font-semibold text-gray-800">
                Ventas de los últimos 7 días
            </h4>
            <div class="h-64 bg-gray-50 p-3 rounded">
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Cargando gráfico de ventas...</p>
                </div>
            </div>
        </div>

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-md">
            <h4 class="mb-4 font-semibold text-gray-800">
                Categorías más populares
            </h4>
            <div class="h-64 bg-gray-50 p-3 rounded">
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Cargando gráfico de categorías...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent sales -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Ventas recientes
    </h2>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Monto</th>
                        <th class="px-4 py-3">Empleado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach(\App\Models\Venta::with(['cliente', 'empleado'])->latest()->take(5)->get() as $venta)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ $venta->cliente->nombre }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $venta->fecha->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            ${{ number_format($venta->total, 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $venta->empleado->nombre }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
