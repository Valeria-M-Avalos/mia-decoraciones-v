<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Gestión de Reservas</h2>

    <!-- BOTÓN NUEVA RESERVA -->
    <button wire:click="crear"
        class="px-4 py-2 mb-6 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
        + Nueva Reserva
    </button>

    <!-- FILTROS -->
    <div class="flex gap-6 mb-6">

        <!-- Filtro por cliente -->
        <div class="w-1/3">
            <label class="block font-medium mb-1">Filtrar por cliente</label>
            <select wire:model="filtro_cliente" class="w-full border rounded px-2 py-1">
                <option value="">-- Todos --</option>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por estado -->
        <div class="w-1/3">
            <label class="block font-medium mb-1">Estado</label>
            <select wire:model="filtro_estado" class="w-full border rounded px-2 py-1">
                <option value="">-- Todos --</option>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

    </div>

    <!-- TABLA -->
    <table class="w-full border-collapse bg-white shadow">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Fecha de Reserva</th>
                <th class="border px-3 py-2">Cliente</th>
                <th class="border px-3 py-2">Evento</th>
                <th class="border px-3 py-2">Seña</th>
                <th class="border px-3 py-2">Total</th>
                <th class="border px-3 py-2">Estado</th>
                <th class="border px-3 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($reservas as $r)
                <tr>
                    <td class="border px-3 py-2">{{ $r->id }}</td>

                    <td class="border px-3 py-2">
                        {{ \Carbon\Carbon::parse($r->fecha_reserva)->format('d/m/Y') }}
                    </td>

                    <td class="border px-3 py-2">
                        {{ $r->cliente?->nombre ?? '—' }}
                    </td>

                    <td class="border px-3 py-2">
                        {{ $r->evento?->titulo ?? '—' }}
                    </td>

                    <td class="border px-3 py-2">
                        @if(!is_null($r->senia))
                            $ {{ number_format($r->senia, 2, ',', '.') }}
                        @else
                            —
                        @endif
                    </td>

                    <td class="border px-3 py-2">
                        $ {{ number_format($r->total, 2, ',', '.') }}
                    </td>

                    <!-- Estado con colores -->
                    <td class="border px-3 py-2">
                        <span class="
                            px-2 py-1 rounded text-white text-sm font-semibold
                            @if($r->estado === 'confirmada') bg-green-600
                            @elseif($r->estado === 'pendiente') bg-yellow-500 text-black
                            @elseif($r->estado === 'cancelada') bg-red-600
                            @endif
                        ">
                            {{ ucfirst($r->estado) }}
                        </span>
                    </td>

                    <td class="border px-3 py-2">
                        <button wire:click="editar({{ $r->id }})"
                            class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</button>

                        <button wire:click="eliminar({{ $r->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">Eliminar</button>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">
                        No hay reservas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- PAGINACIÓN -->
    <div class="mt-4">
        {{ $reservas->links() }}
    </div>



    <!-- ===========================
         MODAL
    ============================ -->
    @if($modal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

            <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl">

                <h3 class="text-xl font-bold mb-4">
                    {{ $reserva_id ? 'Editar Reserva' : 'Nueva Reserva' }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Fecha -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Fecha de Reserva</label>
                        <input type="date" wire:model="fecha_reserva"
                            class="w-full border px-3 py-2 rounded">
                        @error('fecha_reserva') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Cliente</label>
                        <select wire:model="cliente_id"
                            class="w-full border px-3 py-2 rounded">
                            <option value="">-- Seleccione --</option>
                            @foreach($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Evento -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Evento</label>
                        <select wire:model="evento_id"
                            class="w-full border px-3 py-2 rounded">
                            <option value="">-- Seleccione --</option>

                            @foreach($eventos as $ev)
                                <option value="{{ $ev->id }}">
                                    {{ $ev->titulo }} — ${{ number_format($ev->costo, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('evento_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Seña -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Seña</label>
                        <input type="number" step="0.01" min="0"
                            wire:model="senia"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <!-- Total (calculado) -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Total</label>
                        <input type="number" readonly
                            wire:model="total"
                            class="w-full border px-3 py-2 rounded bg-gray-100">
                    </div>

                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Estado</label>
                        <select wire:model="estado" class="w-full border px-3 py-2 rounded">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>

                    <!-- Método de pago -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Método de pago</label>
                        <input type="text" wire:model="metodo_pago"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Observaciones</label>
                        <textarea wire:model="observaciones" rows="3"
                            class="w-full border px-3 py-2 rounded"></textarea>
                    </div>

                </div>

                <!-- BOTONES -->
                <div class="flex justify-end mt-6">
                    <button wire:click="cerrarModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2 hover:bg-gray-600">
                        Cancelar
                    </button>

                    <button wire:click="guardar"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
