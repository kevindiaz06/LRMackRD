@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalles del Libro
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('libros.index') }}" class="btn-secondary">
                Volver
            </a>
            <a href="{{ route('libros.edit', $libro) }}" class="btn-primary">
                Editar
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ $libro->titulo }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-700 font-semibold">Autor</p>
                    <p class="text-gray-600">{{ $libro->autor }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">ISBN</p>
                    <p class="text-gray-600">{{ $libro->isbn }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Categoría</p>
                    <p class="text-gray-600">{{ $libro->categoria->nombre }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Proveedor</p>
                    <p class="text-gray-600">{{ $libro->proveedor->nombre }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Precio</p>
                    <p class="text-gray-600">${{ number_format($libro->precio, 2) }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Stock</p>
                    <p class="text-gray-600">{{ $libro->stock }} unidades</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-gray-700 font-semibold">Descripción</p>
                <p class="text-gray-600">{{ $libro->descripcion ?: 'Sin descripción' }}</p>
            </div>

            <div class="border-t pt-4">
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Fecha de creación:</span> {{ $libro->created_at->format('d/m/Y H:i') }}
                </p>
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Última actualización:</span> {{ $libro->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="mt-6 flex justify-end">
                <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary bg-red-100 text-red-600 hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
