<div class="p-6 cliente-crud">

    <h2 class="text-2xl font-bold mb-6">Gestión de Clientes</h2>

    <button wire:click="crear"
        class="px-4 py-2 mb-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
        + Nuevo Cliente
        
    </button>

    <!-- TABLA -->
    <table class="w-full border-collapse bg-white shadow">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Nombre</th>
                <th class="border px-3 py-2">Correo</th>
                <th class="border px-3 py-2">Teléfono</th>
                <th class="border px-3 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $c)
                <tr>
                    <td class="border px-3 py-2">{{ $c->id }}</td>
                    <td class="border px-3 py-2">{{ $c->nombre }}</td>
                    <td class="border px-3 py-2">{{ $c->email }}</td>
                    <td class="border px-3 py-2">{{ $c->telefono }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="editar({{ $c->id }})"
                            class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</button>

                        <button wire:click="eliminar({{ $c->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        No hay clientes aún.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $clientes->links() }}

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-96">

                <h3 class="text-xl font-bold mb-4">
                    {{ $cliente_id ? 'Editar Cliente' : 'Nuevo Cliente' }}
                </h3>

                <div class="mb-3">
                    <label>Nombre</label>
                    <input wire:model="nombre" type="text"
                        class="w-full border px-3 py-2 rounded">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label>Correo electrónico</label>
                    <input wire:model="email" type="email"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div class="mb-3">
                    <label>Teléfono</label>
                    <input wire:model="telefono" type="text"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div class="flex justify-end">
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
