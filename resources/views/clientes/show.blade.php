@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalles del Cliente
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('clientes.index') }}" class="btn-secondary">
                Volver
            </a>
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn-primary">
                Editar
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ $cliente->nombre }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-700 font-semibold">Email</p>
                    <p class="text-gray-600">{{ $cliente->email }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Teléfono</p>
                    <p class="text-gray-600">{{ $cliente->telefono ?: 'No especificado' }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Dirección</p>
                    <p class="text-gray-600">{{ $cliente->direccion ?: 'No especificada' }}</p>
                </div>
            </div>

            <div class="border-t pt-4">
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Fecha de registro:</span> {{ $cliente->created_at->format('d/m/Y H:i') }}
                </p>
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Última actualización:</span> {{ $cliente->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <!-- Historial de Ventas -->
            @if($cliente->ventas && $cliente->ventas->count() > 0)
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Historial de Ventas</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 text-left">Fecha</th>
                                    <th class="py-2 px-4 text-left">Total</th>
                                    <th class="py-2 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->ventas as $venta)
                                    <tr class="border-t">
                                        <td class="py-2 px-4">{{ $venta->fecha->format('d/m/Y') }}</td>
                                        <td class="py-2 px-4">${{ number_format($venta->total, 2) }}</td>
                                        <td class="py-2 px-4">
                                            <a href="{{ route('ventas.show', $venta) }}" class="text-blue-500 hover:underline">Ver detalles</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="mt-8 p-4 bg-gray-50 rounded-md">
                    <p class="text-gray-500">Este cliente no tiene ventas registradas.</p>
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary bg-red-100 text-red-600 hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
