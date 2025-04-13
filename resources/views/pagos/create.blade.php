@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Registrar Nuevo Pago
    </h2>

    <div class="card">
        <form action="{{ route('pagos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="venta_id" class="form-label">Venta</label>
                <select name="venta_id" id="venta_id" class="form-input" required>
                    <option value="">Seleccione una venta</option>
                    @foreach($ventas as $venta)
                        <option value="{{ $venta->id }}" data-total="{{ $venta->total }}" {{ old('venta_id') == $venta->id ? 'selected' : '' }}>
                            #{{ $venta->id }} - {{ $venta->cliente->nombre }} - ${{ number_format($venta->total, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('venta_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha" class="form-label">Fecha de Pago</label>
                <input type="date" name="fecha" id="fecha" class="form-input" value="{{ old('fecha', date('Y-m-d')) }}" required>
                @error('fecha')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="monto" class="form-label">Monto</label>
                <input type="number" name="monto" id="monto" class="form-input" value="{{ old('monto') }}" step="0.01" min="0" required>
                @error('monto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Total de la venta: <span id="total-venta">$0.00</span></p>
            </div>

            <div class="mb-4">
                <label for="metodo" class="form-label">Método de Pago</label>
                <select name="metodo" id="metodo" class="form-input" required>
                    <option value="">Seleccione un método</option>
                    <option value="Efectivo" {{ old('metodo') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    <option value="Tarjeta" {{ old('metodo') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    <option value="Transferencia" {{ old('metodo') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                </select>
                @error('metodo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('pagos.index') }}" class="btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ventaSelect = document.getElementById('venta_id');
            const montoInput = document.getElementById('monto');
            const totalVenta = document.getElementById('total-venta');

            ventaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    const total = parseFloat(selectedOption.dataset.total);
                    totalVenta.textContent = `$${total.toFixed(2)}`;
                    montoInput.value = total.toFixed(2);
                } else {
                    totalVenta.textContent = '$0.00';
                    montoInput.value = '';
                }
            });

            // Inicializar con el valor seleccionado si existe
            if (ventaSelect.value) {
                const selectedOption = ventaSelect.options[ventaSelect.selectedIndex];
                const total = parseFloat(selectedOption.dataset.total);
                totalVenta.textContent = `$${total.toFixed(2)}`;
                if (!montoInput.value) {
                    montoInput.value = total.toFixed(2);
                }
            }
        });
    </script>
    @endpush
@endsection
