<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestión de Eventos</h2>
        <button wire:click="crear" class="btn-mia-primary shadow-lg shadow-pink-200">
            + Nuevo Evento
        </button>
    </div>

    <!-- FILTROS -->
    <div class="mia-card mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
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
                <option value="confirmado">Confirmado</option>
                <option value="pendiente">Pendiente</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>

        <!-- Buscador -->
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Buscar</label>
            <input type="text" wire:model="busqueda" class="mia-input" placeholder="Buscar por título o lugar...">
        </div>
    </div>

    <!-- TABLA -->
    <div class="mia-card overflow-hidden !p-0">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    {{-- ID --}}
                    <th wire:click="ordenarPor('id')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        ID @if($sortField === 'id') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- TÍTULO --}}
                    <th wire:click="ordenarPor('titulo')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Título @if($sortField === 'titulo') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- FECHA --}}
                    <th wire:click="ordenarPor('fecha')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Fecha @if($sortField === 'fecha') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- HORA --}}
                    <th wire:click="ordenarPor('hora')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Hora @if($sortField === 'hora') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- LUGAR --}}
                    <th wire:click="ordenarPor('lugar')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Lugar @if($sortField === 'lugar') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- CLIENTE --}}
                    <th wire:click="ordenarPor('cliente_id')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Cliente @if($sortField === 'cliente_id') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- ESTADO --}}
                    <th wire:click="ordenarPor('estado')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Estado @if($sortField === 'estado') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    {{-- COSTO --}}
                    <th wire:click="ordenarPor('costo')" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">
                        Costo @if($sortField === 'costo') <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span> @endif
                    </th>

                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($eventos as $ev)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">#{{ $ev->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $ev->titulo }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($ev->fecha)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $ev->hora }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $ev->lugar }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $ev->cliente?->nombre ?? '—' }}</td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border
                                @if($ev->estado === 'confirmado') bg-green-100 text-green-700 border-green-500
                                @elseif($ev->estado === 'pendiente') bg-yellow-100 text-yellow-700 border-yellow-500
                                @elseif($ev->estado === 'cancelado') bg-red-100 text-red-700 border-red-500
                                @endif">
                                {{ ucfirst($ev->estado) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if(!is_null($ev->costo)) ${{ number_format($ev->costo, 2, ',', '.') }} @else — @endif
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="editar({{ $ev->id }})" class="px-3 py-1 text-sm font-medium rounded-lg border border-blue-500 text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-150">Editar</button>
                            <button wire:click="eliminar({{ $ev->id }})" class="px-3 py-1 text-sm font-medium rounded-lg border border-red-500 text-red-700 bg-red-50 hover:bg-red-100 transition duration-150">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-400">
                            No hay eventos aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $eventos->links() }}
    </div>

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden">
                
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $evento_id ? 'Editar Evento' : 'Nuevo Evento' }}
                    </h3>
                    <button wire:click="cerrarModal" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5 overflow-y-auto max-h-[80vh]">

                    <!-- Título -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input wire:model="titulo" type="text" class="mia-input">
                        @error('titulo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cliente -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente asociado</label>
                        <select wire:model="cliente_id" class="mia-select">
                            <option value="">-- Sin cliente --</option>
                            @foreach($clientes as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input wire:model="fecha" type="date" class="mia-input">
                        @error('fecha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Hora -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                        <input wire:model="hora" type="time" class="mia-input">
                        @error('hora') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Lugar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lugar</label>
                        <input wire:model="lugar" type="text" class="mia-input">
                        @error('lugar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tipo de evento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de evento</label>
                        <input wire:model="tipo_evento" type="text" class="mia-input">
                        @error('tipo_evento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Invitados -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad de invitados</label>
                        <input wire:model="invitados" type="number" min="1" class="mia-input">
                        @error('invitados') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Costo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Costo</label>
                        <input wire:model="costo" type="number" step="0.01" min="0" class="mia-input">
                        @error('costo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea wire:model="descripcion" rows="3" class="mia-input"></textarea>
                        @error('descripcion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select wire:model="estado" class="mia-select">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                </div>

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
