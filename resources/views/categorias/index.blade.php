@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mt-6 mb-4">
        <h2 class="text-2xl font-semibold text-gray-700">
            Categorías
        </h2>
        <a href="{{ route('categorias.create') }}" class="btn-primary">
            Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Descripción</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($categorias as $categoria)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $categoria->id }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $categoria->nombre }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ Str::limit($categoria->descripcion, 50) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('categorias.show', $categoria) }}" class="text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-500 hover:underline">Editar</a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-sm text-center text-gray-500">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t">
            {{ $categorias->links() }}
        </div>
    </div>
@endsection
