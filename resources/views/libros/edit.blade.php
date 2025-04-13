@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Editar Libro
    </h2>

    <div class="card">
        <form action="{{ route('libros.update', $libro) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-input" value="{{ old('titulo', $libro->titulo) }}" required>
                @error('titulo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" id="autor" class="form-input" value="{{ old('autor', $libro->autor) }}" required>
                @error('autor')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-input" value="{{ old('isbn', $libro->isbn) }}" required>
                @error('isbn')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" id="precio" class="form-input" value="{{ old('precio', $libro->precio) }}" step="0.01" min="0" required>
                @error('precio')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-input" value="{{ old('stock', $libro->stock) }}" min="0" required>
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-input" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ (old('categoria_id', $libro->categoria_id) == $categoria->id) ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-input" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ (old('proveedor_id', $libro->proveedor_id) == $proveedor->id) ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('proveedor_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-input" rows="4">{{ old('descripcion', $libro->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('libros.index') }}" class="btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
