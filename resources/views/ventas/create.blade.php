@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Registrar Nueva Venta
    </h2>

    <div class="card">
        <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-input" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="empleado_id" class="form-label">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-input" required>
                        <option value="">Seleccione un empleado</option>
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('empleado_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-input" value="{{ old('fecha', date('Y-m-d')) }}" required>
                    @error('fecha')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-3">Productos</h3>

            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white" id="productos-table">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 text-left">Libro</th>
                                <th class="py-2 px-4 text-left">Precio</th>
                                <th class="py-2 px-4 text-left">Cantidad</th>
                                <th class="py-2 px-4 text-left">Subtotal</th>
                                <th class="py-2 px-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productos-body">
                            <tr id="empty-row">
                                <td colspan="5" class="py-2 px-4 text-center text-gray-500">
                                    No hay productos agregados a la venta
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-right font-semibold">Total:</td>
                                <td class="py-2 px-4 font-semibold" id="total-venta">$0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="libro_id" class="form-label">Seleccionar Libro</label>
                        <select id="libro_id" class="form-input">
                            <option value="">Seleccione un libro</option>
                            @foreach($libros as $libro)
                                <option value="{{ $libro->id }}" data-precio="{{ $libro->precio }}" data-stock="{{ $libro->stock }}">
                                    {{ $libro->titulo }} (Stock: {{ $libro->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" id="cantidad" class="form-input" min="1" value="1">
                    </div>
                    <div class="flex items-end">
                        <button type="button" id="agregar-producto" class="btn-secondary">
                            Agregar Producto
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('ventas.index') }}" class="btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar Venta</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const librosSelect = document.getElementById('libro_id');
            const cantidadInput = document.getElementById('cantidad');
            const agregarBtn = document.getElementById('agregar-producto');
            const productosBody = document.getElementById('productos-body');
            const emptyRow = document.getElementById('empty-row');
            const totalVenta = document.getElementById('total-venta');
            const ventaForm = document.getElementById('ventaForm');

            let productos = [];
            let total = 0;

            // Agregar producto
            agregarBtn.addEventListener('click', function() {
                const libroId = librosSelect.value;
                if (!libroId) {
                    alert('Por favor seleccione un libro');
                    return;
                }

                const cantidad = parseInt(cantidadInput.value);
                if (isNaN(cantidad) || cantidad < 1) {
                    alert('La cantidad debe ser mayor a 0');
                    return;
                }

                const selectedOption = librosSelect.options[librosSelect.selectedIndex];
                const precio = parseFloat(selectedOption.dataset.precio);
                const stock = parseInt(selectedOption.dataset.stock);
                const titulo = selectedOption.text.split(' (Stock:')[0];

                if (cantidad > stock) {
                    alert(`Stock insuficiente. Solo hay ${stock} unidades disponibles.`);
                    return;
                }

                // Verificar si el producto ya existe
                const existeIndex = productos.findIndex(p => p.id === libroId);
                if (existeIndex !== -1) {
                    const nuevoTotal = productos[existeIndex].cantidad + cantidad;
                    if (nuevoTotal > stock) {
                        alert(`Stock insuficiente. Solo hay ${stock} unidades disponibles.`);
                        return;
                    }
                    productos[existeIndex].cantidad = nuevoTotal;
                    productos[existeIndex].subtotal = nuevoTotal * precio;
                } else {
                    productos.push({
                        id: libroId,
                        titulo: titulo,
                        precio: precio,
                        cantidad: cantidad,
                        subtotal: cantidad * precio
                    });
                }

                actualizarTabla();

                // Limpiar selección
                librosSelect.value = '';
                cantidadInput.value = 1;
            });

            // Actualizar tabla
            function actualizarTabla() {
                if (productos.length === 0) {
                    emptyRow.style.display = 'table-row';
                    totalVenta.textContent = '$0.00';
                    total = 0;
                    return;
                }

                emptyRow.style.display = 'none';

                // Limpiar tabla
                let filas = productosBody.querySelectorAll('tr:not(#empty-row)');
                filas.forEach(fila => fila.remove());

                // Recalcular total
                total = 0;

                // Agregar productos a la tabla
                productos.forEach((producto, index) => {
                    const row = document.createElement('tr');
                    row.className = 'border-t';
                    row.innerHTML = `
                        <td class="py-2 px-4">${producto.titulo}</td>
                        <td class="py-2 px-4">$${producto.precio.toFixed(2)}</td>
                        <td class="py-2 px-4">${producto.cantidad}</td>
                        <td class="py-2 px-4">$${producto.subtotal.toFixed(2)}</td>
                        <td class="py-2 px-4">
                            <button type="button" class="text-red-500 hover:text-red-700" data-index="${index}">
                                Eliminar
                            </button>
                            <input type="hidden" name="libros[${index}][id]" value="${producto.id}">
                            <input type="hidden" name="libros[${index}][cantidad]" value="${producto.cantidad}">
                        </td>
                    `;

                    productosBody.appendChild(row);
                    total += producto.subtotal;

                    // Agregar evento eliminar
                    row.querySelector('button').addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        productos.splice(index, 1);
                        actualizarTabla();
                    });
                });

                totalVenta.textContent = `$${total.toFixed(2)}`;
            }

            // Validar formulario antes de enviar
            ventaForm.addEventListener('submit', function(e) {
                if (productos.length === 0) {
                    e.preventDefault();
                    alert('Debe agregar al menos un producto a la venta');
                }
            });
        });
    </script>
    @endpush
@endsection
