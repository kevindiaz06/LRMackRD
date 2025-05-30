@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Crear Proveedor
    </h2>

    <div class="card">
        <form action="{{ route('proveedores.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-input" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contacto" class="form-label">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="form-input" value="{{ old('contacto') }}">
                @error('contacto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-input" value="{{ old('telefono') }}">
                @error('telefono')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('proveedores.index') }}" class="btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection
