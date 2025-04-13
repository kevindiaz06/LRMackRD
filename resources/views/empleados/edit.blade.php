@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Editar Empleado
    </h2>

    <div class="card">
        <form action="{{ route('empleados.update', $empleado) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-input" value="{{ old('nombre', $empleado->nombre) }}" required>
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-input" value="{{ old('cargo', $empleado->cargo) }}" required>
                @error('cargo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $empleado->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-input" value="{{ old('telefono', $empleado->telefono) }}">
                @error('telefono')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-input" value="{{ old('fecha_contratacion', $empleado->fecha_contratacion->format('Y-m-d')) }}" required>
                @error('fecha_contratacion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salario" class="form-label">Salario</label>
                <input type="number" name="salario" id="salario" class="form-input" value="{{ old('salario', $empleado->salario) }}" step="0.01" min="0" required>
                @error('salario')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('empleados.index') }}" class="btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
