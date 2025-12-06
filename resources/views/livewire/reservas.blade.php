<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestión de Reservas</h2>
        <button wire:click="crear" class="btn-mia-primary shadow-lg shadow-pink-200">
            + Nueva Reserva
        </button>
    </div>

    <!-- FILTROS -->
    <div class="mia-card mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Filtro por cliente -->
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Filtrar por cliente</label>
            <select wire:model="filtro_cliente" class="mia-select">
                <option value="">-- Todos --</option>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por estado -->
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Estado</label>
            <select wire:model="filtro_estado" class="mia-select">
                <option value="">-- Todos --</option>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
    </div>

    <!-- TABLA -->
    <div class="mia-card overflow-hidden !p-0">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="mia-table-header px-6">ID</th>
                    <th class="mia-table-header px-6">Fecha de Reserva</th>
                    <th class="mia-table-header px-6">Cliente</th>
                    <th class="mia-table-header px-6">Evento</th>
                    <th class="mia-table-header px-6">Seña</th>
                    <th class="mia-table-header px-6">Total</th>
                    <th class="mia-table-header px-6">Estado</th>
                    <th class="mia-table-header px-6 text-right">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($reservas as $r)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">#{{ $r->id }}</td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($r->fecha_reserva)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                            {{ $r->cliente?->nombre ?? '—' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $r->evento?->titulo ?? '—' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if(!is_null($r->senia))
                                ${{ number_format($r->senia, 2, ',', '.') }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="px-6 py-4 text-sm font-bold text-gray-700">
                            ${{ number_format($r->total, 2, ',', '.') }}
                        </td>

                        <!-- Estado con colores -->
                       <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border 
                                @if($r->estado === 'confirmada') bg-green-100 text-green-700 border-green-500 
                                @elseif($r->estado === 'pendiente') bg-yellow-100 text-yellow-700 border-yellow-500
                                @elseif($r->estado === 'cancelada') bg-red-100 text-red-700 border-red-500
                                @endif">
                                {{ ucfirst($r->estado) }}
                            </span>
                       </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="editar({{ $r->id }})" class="btn-mia-edit">Editar</button>
                            <button wire:click="eliminar({{ $r->id }})" class="btn-mia-delete">Eliminar</button>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-400">
                            No hay reservas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINACIÓN -->
    <div class="mt-4">
        {{ $reservas->links() }}
    </div>
    <!-- ===========================
         MODAL
    ============================ -->
    @if($modal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">

            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden">

                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $reserva_id ? 'Editar Reserva' : 'Nueva Reserva' }}
                    </h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5 overflow-y-auto max-h-[80vh]">

                    <!-- Fecha -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Reserva</label>
                        <input type="date" wire:model="fecha_reserva" class="mia-input">
                        @error('fecha_reserva') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <select wire:model="cliente_id" class="mia-select">
                            <option value="">-- Seleccione --</option>
                            @foreach($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeachad
                        </select>
                    </div>

                    <!-- Evento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>
                        <select wire:model="evento_id" class="mia-select">
                            <option value="">-- Seleccione --</option>
                            @foreach($eventos as $ev)
                                <option value="{{ $ev->id }}">
                                    {{ $ev->titulo }} — ${{ number_format($ev->costo, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('evento_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Seña -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seña</label>
                        <input type="number" step="0.01" min="0" wire:model="senia" class="mia-input">
                    </div>

                    <!-- Total (calculado) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total</label>
                        <input type="number" readonly wire:model="total" class="mia-input bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>

                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select wire:model="estado" class="mia-select">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>

                    <!-- Método de pago -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Método de pago</label>
                        <input type="text" wire:model="metodo_pago" class="mia-input">
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
                        <textarea wire:model="observaciones" rows="3" class="mia-input"></textarea>
                    </div>

                </div>

                <!-- BOTONES -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                    <button wire:click="cerrarModal" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                        Cancelar
                    </button>

                    <button wire:click="guardar" class="btn-mia-primary">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
