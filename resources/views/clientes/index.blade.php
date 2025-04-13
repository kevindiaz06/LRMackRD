@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Clientes
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('clientes.create') }}" class="btn-primary">
                Nuevo Cliente
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
                        <th class="px-4 py-3">Dirección</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($clientes as $cliente)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $cliente->nombre }}</td>
                            <td class="px-4 py-3">{{ $cliente->email }}</td>
                            <td class="px-4 py-3">{{ $cliente->telefono }}</td>
                            <td class="px-4 py-3">{{ $cliente->direccion }}</td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('clientes.show', $cliente) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
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
                            <td colspan="5" class="px-4 py-3 text-center">No hay clientes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $clientes->links() }}
        </div>
    </div>
@endsection
