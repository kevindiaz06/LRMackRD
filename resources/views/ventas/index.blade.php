@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Ventas
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('ventas.create') }}" class="btn-primary">
                Nueva Venta
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Empleado</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($ventas as $venta)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $venta->fecha->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $venta->cliente->nombre }}</td>
                            <td class="px-4 py-3">{{ $venta->empleado->nombre }}</td>
                            <td class="px-4 py-3">${{ number_format($venta->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                    {{ $venta->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('ventas.show', $venta) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('ventas.edit', $venta) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('ventas.destroy', $venta) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center">No hay ventas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $ventas->links() }}
        </div>
    </div>
@endsection
