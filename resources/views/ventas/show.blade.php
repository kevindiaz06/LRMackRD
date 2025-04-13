@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Detalles de la Venta
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('ventas.index') }}" class="btn-secondary">
                Volver
            </a>
            <a href="{{ route('facturas.create') }}?venta_id={{ $venta->id }}" class="btn-primary">
                Generar Factura
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <p class="text-gray-700 font-semibold">Número de Venta</p>
                    <p class="text-gray-600">#{{ $venta->id }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Fecha</p>
                    <p class="text-gray-600">{{ $venta->fecha->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Total</p>
                    <p class="text-gray-600 text-lg font-bold">${{ number_format($venta->total, 2) }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Cliente</p>
                    <p class="text-gray-600">{{ $venta->cliente->nombre }}</p>
                    <p class="text-gray-500 text-sm">{{ $venta->cliente->email }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Vendedor</p>
                    <p class="text-gray-600">{{ $venta->empleado->nombre }}</p>
                    <p class="text-gray-500 text-sm">{{ $venta->empleado->cargo }}</p>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold">Estado</p>
                    <p class="text-gray-600">
                        @if($venta->factura)
                            <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">Facturada</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm">Pendiente de facturar</span>
                        @endif
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Detalle de Productos</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 text-left">Producto</th>
                            <th class="py-2 px-4 text-left">Precio Unitario</th>
                            <th class="py-2 px-4 text-left">Cantidad</th>
                            <th class="py-2 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venta->detalles as $detalle)
                            <tr class="border-t">
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="font-medium">{{ $detalle->libro->titulo }}</p>
                                        <p class="text-gray-500 text-sm">{{ $detalle->libro->autor }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4">${{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="py-3 px-4">{{ $detalle->cantidad }}</td>
                                <td class="py-3 px-4 text-right">${{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t">
                            <td colspan="3" class="py-3 px-4 text-right font-bold">Total:</td>
                            <td class="py-3 px-4 text-right font-bold">${{ number_format($venta->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($venta->factura)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Información de Facturación</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-gray-700 font-semibold">Número de Factura</p>
                                <p class="text-gray-600">{{ $venta->factura->numero }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700 font-semibold">Fecha de Emisión</p>
                                <p class="text-gray-600">{{ $venta->factura->fecha->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700 font-semibold">Total Facturado</p>
                                <p class="text-gray-600">${{ number_format($venta->factura->total_con_impuestos, 2) }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('facturas.show', $venta->factura) }}" class="text-blue-500 hover:underline">
                                Ver detalles de factura
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="border-t pt-4 mt-8">
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Fecha de registro:</span> {{ $venta->created_at->format('d/m/Y H:i') }}
                </p>
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">Última actualización:</span> {{ $venta->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </div>
@endsection
