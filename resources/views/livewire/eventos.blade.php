<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Gestión de Eventos</h2>

    <!-- BOTÓN NUEVO -->
    <button wire:click="crear"
        class="px-4 py-2 mb-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
        + Nuevo Evento
    </button>

    <!-- FILTROS -->
    <div class="flex gap-4 mb-6">

        <!-- Filtro por cliente -->
        <div class="w-1/3">
            <label class="block font-medium">Filtrar por cliente</label>
            <select wire:model="filtro_cliente" class="w-full border rounded px-2 py-1">
                <option value="">-- Todos --</option>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por estado -->
        <div class="w-1/3">
            <label class="block font-medium">Estado</label>
            <select wire:model="filtro_estado" class="w-full border rounded px-2 py-1">
                <option value="">-- Todos --</option>
                <option value="confirmado">Confirmado</option>
                <option value="pendiente">Pendiente</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>

        <!-- Buscador -->
        <div class="w-1/3">
            <label class="block font-medium">Buscar</label>
            <input type="text" wire:model="busqueda"
                class="w-full border rounded px-2 py-1"
                placeholder="Buscar por título o lugar...">
        </div>

    </div>

    <!-- TABLA -->
    <table class="w-full border-collapse bg-white shadow">
        <thead>
            <tr class="bg-gray-100 text-left">

                {{-- ID --}}
                <th wire:click="ordenarPor('id')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    ID
                    @if($sortField === 'id')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- TÍTULO --}}
                <th wire:click="ordenarPor('titulo')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Título
                    @if($sortField === 'titulo')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- FECHA --}}
                <th wire:click="ordenarPor('fecha')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Fecha
                    @if($sortField === 'fecha')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- HORA --}}
                <th wire:click="ordenarPor('hora')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Hora
                    @if($sortField === 'hora')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- LUGAR --}}
                <th wire:click="ordenarPor('lugar')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Lugar
                    @if($sortField === 'lugar')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- CLIENTE (orden por cliente_id) --}}
                <th wire:click="ordenarPor('cliente_id')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Cliente
                    @if($sortField === 'cliente_id')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- ESTADO --}}
                <th wire:click="ordenarPor('estado')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Estado
                    @if($sortField === 'estado')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                {{-- COSTO --}}
                <th wire:click="ordenarPor('costo')"
                    class="border px-3 py-2 cursor-pointer select-none">
                    Costo
                    @if($sortField === 'costo')
                        <span class="text-xs">
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        </span>
                    @endif
                </th>

                <th class="border px-3 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($eventos as $ev)
                <tr>
                    <td class="border px-3 py-2">{{ $ev->id }}</td>
                    <td class="border px-3 py-2">{{ $ev->titulo }}</td>
                    <td class="border px-3 py-2">
                        {{ \Carbon\Carbon::parse($ev->fecha)->format('d/m/Y') }}
                    </td>
                    <td class="border px-3 py-2">{{ $ev->hora }}</td>
                    <td class="border px-3 py-2">{{ $ev->lugar }}</td>
                    <td class="border px-3 py-2">
                        {{ $ev->cliente?->nombre ?? '—' }}
                    </td>

                    <td class="border px-3 py-2">
                        <span class="
                            px-2 py-1 rounded text-white text-sm font-semibold
                            @if($ev->estado === 'confirmado') bg-green-600
                            @elseif($ev->estado === 'pendiente') bg-yellow-500 text-black
                            @elseif($ev->estado === 'cancelado') bg-red-600
                            @endif
                        ">
                            {{ $ev->estado }}
                        </span>
                    </td>

                    <td class="border px-3 py-2">
                        @if(!is_null($ev->costo))
                            $ {{ number_format($ev->costo, 2, ',', '.') }}
                        @else
                            —
                        @endif
                    </td>

                    <td class="border px-3 py-2">
                        <button wire:click="editar({{ $ev->id }})"
                            class="px-2 py-1 bg-yellow-500 text-white rounded">
                            Editar
                        </button>

                        <button wire:click="eliminar({{ $ev->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-gray-500">
                        No hay eventos aún.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $eventos->links() }}

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl">

                <h3 class="text-xl font-bold mb-4">
                    {{ $evento_id ? 'Editar Evento' : 'Nuevo Evento' }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Título -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Título</label>
                        <input wire:model="titulo" type="text"
                            class="w-full border px-3 py-2 rounded">
                        @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Cliente asociado</label>
                        <select wire:model="cliente_id" class="w-full border px-3 py-2 rounded">
                            <option value="">-- Sin cliente --</option>
                            @foreach($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Fecha</label>
                        <input wire:model="fecha" type="date"
                            class="w-full border px-3 py-2 rounded">
                        @error('fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Hora -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Hora</label>
                        <input wire:model="hora" type="time"
                            class="w-full border px-3 py-2 rounded">
                        @error('hora') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Lugar -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Lugar</label>
                        <input wire:model="lugar" type="text"
                            class="w-full border px-3 py-2 rounded">
                        @error('lugar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tipo de evento -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Tipo de evento</label>
                        <input wire:model="tipo_evento" type="text"
                            class="w-full border px-3 py-2 rounded">
                        @error('tipo_evento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Invitados -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Cantidad de invitados</label>
                        <input wire:model="invitados" type="number" min="1"
                            class="w-full border px-3 py-2 rounded">
                        @error('invitados') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Costo -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Costo</label>
                        <input wire:model="costo" type="number" step="0.01" min="0"
                            class="w-full border px-3 py-2 rounded">
                        @error('costo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Descripción</label>
                        <textarea wire:model="descripcion" rows="3"
                            class="w-full border px-3 py-2 rounded"></textarea>
                        @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Estado</label>
                        <select wire:model="estado" class="w-full border px-3 py-2 rounded">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="flex justify-end mt-6">
                    <button wire:click="cerrarModal"
                        class="px-4 py-2 bg-gray-500 text-white font-semibold rounded mr-2 hover:bg-gray-600">
                        Cancelar
                    </button>

                    <button wire:click="guardar"
                        class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
