@extends('layouts.app')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Pagos
    </h2>

    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('pagos.create') }}" class="btn-primary">
                Nuevo Pago
            </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Venta</th>
                        <th class="px-4 py-3">Método</th>
                        <th class="px-4 py-3">Monto</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($pagos as $pago)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $pago->venta_id }}</td>
                            <td class="px-4 py-3">{{ $pago->metodo_pago }}</td>
                            <td class="px-4 py-3">${{ number_format($pago->monto, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 font-semibold leading-tight {{ $pago->estado == 'Completado' ? 'text-green-700 bg-green-100' : 'text-yellow-700 bg-yellow-100' }} rounded-full">
                                    {{ $pago->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                <a href="{{ route('pagos.show', $pago) }}" class="text-blue-500 hover:text-blue-700">
                                    Ver
                                </a>
                                <a href="{{ route('pagos.edit', $pago) }}" class="text-green-500 hover:text-green-700">
                                    Editar
                                </a>
                                <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center">No hay pagos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $pagos->links() }}
        </div>
    </div>
@endsection
