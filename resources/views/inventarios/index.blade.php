@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Inventario
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('inventarios.create') }}" class="btn-primary">
                Nuevo Registro de Inventario
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Libro</th>
                        <th class="px-4 py-3">Cantidad</th>
                        <th class="px-4 py-3">Fecha Actualización</th>
                        <th class="px-4 py-3">Tipo Movimiento</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($inventarios as $inventario)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $inventario->libro->titulo }}</td>
                            <td class="px-4 py-3">{{ $inventario->cantidad }}</td>
                            <td class="px-4 py-3">{{ $inventario->fecha_actualizacion->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 font-semibold leading-tight {{ $inventario->tipo_movimiento == 'Entrada' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                    {{ $inventario->tipo_movimiento }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('inventarios.show', $inventario) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('inventarios.edit', $inventario) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('inventarios.destroy', $inventario) }}" method="POST" class="inline">
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
                            <td colspan="5" class="px-4 py-3 text-center">No hay registros de inventario</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $inventarios->links() }}
        </div>
    </div>
@endsection
