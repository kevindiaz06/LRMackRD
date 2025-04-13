@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalles del Proveedor
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn-primary">Editar</a>
            <a href="{{ route('proveedores.index') }}" class="btn-secondary">Volver</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Información del Proveedor</h3>
                <dl class="space-y-2">
                    <div class="grid grid-cols-2">
                        <dt class="font-medium text-gray-500">Nombre:</dt>
                        <dd>{{ $proveedor->nombre }}</dd>
                    </div>
                    <div class="grid grid-cols-2">
                        <dt class="font-medium text-gray-500">Contacto:</dt>
                        <dd>{{ $proveedor->contacto }}</dd>
                    </div>
                    <div class="grid grid-cols-2">
                        <dt class="font-medium text-gray-500">Teléfono:</dt>
                        <dd>{{ $proveedor->telefono }}</dd>
                    </div>
                    <div class="grid grid-cols-2">
                        <dt class="font-medium text-gray-500">Email:</dt>
                        <dd>{{ $proveedor->email }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    @if(isset($proveedor->libros) && $proveedor->libros->count() > 0)
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-4">Libros suministrados</h3>
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Autor</th>
                            <th class="px-4 py-3">Categoría</th>
                            <th class="px-4 py-3">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($proveedor->libros as $libro)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $libro->titulo }}</td>
                            <td class="px-4 py-3">{{ $libro->autor }}</td>
                            <td class="px-4 py-3">{{ $libro->categoria->nombre }}</td>
                            <td class="px-4 py-3">${{ number_format($libro->precio, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endsection
