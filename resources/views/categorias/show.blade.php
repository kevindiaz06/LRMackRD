@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mt-6 mb-4">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalle de Categoría
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('categorias.edit', $categoria) }}" class="btn-primary">
                Editar
            </a>
            <a href="{{ route('categorias.index') }}" class="btn-secondary">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Información General</h3>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-600">ID</p>
                    <p class="text-gray-800">{{ $categoria->id }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-600">Nombre</p>
                    <p class="text-gray-800">{{ $categoria->nombre }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-600">Descripción</p>
                    <p class="text-gray-800">{{ $categoria->descripcion }}</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Libros en esta Categoría</h3>
                <div class="overflow-hidden rounded-lg border">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($categoria->libros as $libro)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="{{ route('libros.show', $libro) }}" class="text-blue-500 hover:underline">
                                            {{ $libro->titulo }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ $libro->autor }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($libro->precio, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-sm text-center text-gray-500">
                                        No hay libros en esta categoría.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
