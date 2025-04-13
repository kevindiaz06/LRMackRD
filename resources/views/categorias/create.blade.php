@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mt-6 mb-4">
        <h2 class="text-2xl font-semibold text-gray-700">
            Nueva Categoría
        </h2>
        <a href="{{ route('categorias.index') }}" class="btn-secondary">
            Volver al listado
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <x-form-input
                label="Nombre"
                name="nombre"
                required
            />

            <x-form-textarea
                label="Descripción"
                name="descripcion"
                required
            />

            <div class="flex justify-end mt-6">
                <x-button
                    type="submit"
                    color="primary"
                >
                    Guardar Categoría
                </x-button>
            </div>
        </form>
    </div>
@endsection
