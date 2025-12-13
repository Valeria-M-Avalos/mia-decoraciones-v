<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestión de Servicios</h2>
        <button wire:click="crear" class="btn-mia-primary shadow-lg shadow-pink-200">
            + Nuevo servicio
        </button>
    </div>

    <!-- TABLA -->
    <div class="mia-card overflow-hidden !p-0">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="mia-table-header px-6">ID</th>
                    <th class="mia-table-header px-6">Nombre</th>
                    <th class="mia-table-header px-6">Descripción</th>
                    <th class="mia-table-header px-6">Precio</th>
                    <th class="mia-table-header px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($servicios as $s)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">#{{ $s->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $s->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs">{{ $s->descripcion }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-700">${{ number_format($s->precio, 2) }}</td>
                        
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="editar({{ $s->id }})" class="btn-mia-edit">Editar</button>
                            <button wire:click="eliminar({{ $s->id }})" class="btn-mia-delete">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400">
                            No hay servicios aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $servicios->links() }}
    </div>

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
            <div class="bg-white rounded-2xl shadow-xl w-96 overflow-hidden">

                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $servicio_id ? 'Editar Servicio' : 'Nuevo Servicio' }}
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input wire:model="nombre" type="text" class="mia-input">
                        @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea wire:model="descripcion" rows="3" class="mia-input"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                        <input wire:model="precio" type="number" step="0.01" class="mia-input">
                        @error('precio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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