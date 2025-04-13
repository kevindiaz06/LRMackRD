@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Empleados
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('empleados.create') }}" class="btn-primary">
                Nuevo Empleado
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Cargo</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($empleados as $empleado)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $empleado->nombre }}</td>
                            <td class="px-4 py-3">{{ $empleado->email }}</td>
                            <td class="px-4 py-3">{{ $empleado->telefono }}</td>
                            <td class="px-4 py-3">{{ $empleado->cargo }}</td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('empleados.show', $empleado) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('empleados.edit', $empleado) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="inline">
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
                            <td colspan="5" class="px-4 py-3 text-center">No hay empleados registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $empleados->links() }}
        </div>
    </div>
@endsection
