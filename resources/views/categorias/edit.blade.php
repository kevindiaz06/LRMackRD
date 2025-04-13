@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mt-6 mb-4">
        <h2 class="text-2xl font-semibold text-gray-700">
            Editar Categoría
        </h2>
        <a href="{{ route('categorias.index') }}" class="btn-secondary">
            Volver al listado
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form-input
                label="Nombre"
                name="nombre"
                :value="$categoria->nombre"
                required
            />

            <x-form-textarea
                label="Descripción"
                name="descripcion"
                :value="$categoria->descripcion"
                required
            />

            <div class="flex justify-end mt-6">
                <x-button
                    type="submit"
                    color="primary"
                >
                    Actualizar Categoría
                </x-button>
            </div>
        </form>
    </div>
@endsection
