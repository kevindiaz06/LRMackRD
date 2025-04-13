@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalles del Pago
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('pagos.index') }}" class="btn-secondary">
                Volver
            </a>
            <a href="{{ route('pagos.edit', $pago) }}" class="btn-primary">
                Editar
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Pago #{{ $pago->id }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-700 font-semibold">Venta Relacionada</p>
                    <p class="text-gray-600">
                        <a href="{{ route('ventas.show', $pago->venta) }}" class="text-blue-500 hover:underline">
                            Venta #{{ $pago->venta->id }}
                        </a>
                    </p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Cliente</p>
                    <p class="text-gray-600">{{ $pago->venta->cliente->nombre }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Fecha de Pago</p>
                    <p class="text-gray-600">{{ $pago->fecha->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Método de Pago</p>
                    <p class="text-gray-600">{{ $pago->metodo }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Monto</p>
                    <p class="text-gray-600 text-lg font-bold">${{ number_format($pago->monto, 2) }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Total de la Venta</p>
                    <p class="text-gray-600">${{ number_format($pago->venta->total, 2) }}</p>
                </div>
            </div>

            <!-- Resumen de la venta relacionada -->
            <div class="mt-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Resumen de la Venta</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Fecha de Venta</p>
                            <p class="text-gray-600">{{ $pago->venta->fecha->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-700 font-semibold">Empleado</p>
                            <p class="text-gray-600">{{ $pago->venta->empleado->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-gray-700 font-semibold">Cantidad de Productos</p>
                            <p class="text-gray-600">{{ $pago->venta->detalles->sum('cantidad') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t pt-4 mt-8">
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Fecha de registro:</span> {{ $pago->created_at->format('d/m/Y H:i') }}
                </p>
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Última actualización:</span> {{ $pago->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="mt-6 flex justify-end">
                <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary bg-red-100 text-red-600 hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar este pago?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
