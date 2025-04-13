@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Libros
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('libros.create') }}" class="btn-primary">
                Nuevo Libro
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Título</th>
                        <th class="px-4 py-3">Autor</th>
                        <th class="px-4 py-3">Categoría</th>
                        <th class="px-4 py-3">Precio</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($libros as $libro)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $libro->titulo }}</td>
                            <td class="px-4 py-3">{{ $libro->autor }}</td>
                            <td class="px-4 py-3">{{ $libro->categoria->nombre }}</td>
                            <td class="px-4 py-3">${{ number_format($libro->precio, 2) }}</td>
                            <td class="px-4 py-3">{{ $libro->stock }}</td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('libros.show', $libro) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('libros.edit', $libro) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="inline">
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
                            <td colspan="6" class="px-4 py-3 text-center">No hay libros registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $libros->links() }}
        </div>
    </div>
@endsection
