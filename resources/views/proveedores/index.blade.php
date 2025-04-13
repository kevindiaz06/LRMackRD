@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Proveedores
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('proveedores.create') }}" class="btn-primary">
                Nuevo Proveedor
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Contacto</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($proveedores as $proveedor)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $proveedor->nombre }}</td>
                            <td class="px-4 py-3">{{ $proveedor->contacto }}</td>
                            <td class="px-4 py-3">{{ $proveedor->telefono }}</td>
                            <td class="px-4 py-3">{{ $proveedor->email }}</td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('proveedores.show', $proveedor) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="inline">
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
                            <td colspan="5" class="px-4 py-3 text-center">No hay proveedores registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $proveedores->links() }}
        </div>
    </div>
@endsection
