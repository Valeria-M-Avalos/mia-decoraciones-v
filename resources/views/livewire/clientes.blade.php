<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestión de Clientes</h2>
        <!-- Botón Rosa -->
        <button wire:click="crear" class="btn-mia-primary shadow-lg shadow-pink-200">
            + Nuevo Cliente
        </button>
    </div>

    <!-- TABLA -->
    <div class="mia-card overflow-hidden !p-0">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="mia-table-header px-6">ID</th>
                    <th class="mia-table-header px-6">Nombre</th>
                    <th class="mia-table-header px-6">Correo</th>
                    <th class="mia-table-header px-6">Teléfono</th>
                    <th class="mia-table-header px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($clientes as $c)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">#{{ $c->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $c->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $c->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $c->telefono }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="editar({{ $c->id }})" class="btn-mia-edit">Editar</button>
                            <button wire:click="eliminar({{ $c->id }})" class="btn-mia-delete">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400">
                            No hay clientes aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $clientes->links() }}
    </div>

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
            <div class="bg-white rounded-2xl shadow-xl w-96 overflow-hidden">

                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $cliente_id ? 'Editar Cliente' : 'Nuevo Cliente' }}
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input wire:model="nombre" type="text" class="mia-input">
                        @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input wire:model="email" type="email" class="mia-input">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input wire:model="telefono" type="text" class="mia-input">
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