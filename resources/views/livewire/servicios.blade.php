<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Gestión de Servicios</h2>

    <!-- BOTÓN NUEVO -->
    <button wire:click="crear"
        class="px-4 py-2 mb-4 bg-blue-600 text-white rounded hover:bg-blue-700">
        + Nuevo servicio
    </button>

    <!-- TABLA -->
    <table class="w-full border-collapse bg-white shadow">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Nombre</th>
                <th class="border px-3 py-2">Descripción</th>
                <th class="border px-3 py-2">Precio</th>
                <th class="border px-3 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($servicios as $s)
                <tr>
                    <td class="border px-3 py-2">{{ $s->id }}</td>
                    <td class="border px-3 py-2">{{ $s->nombre }}</td>
                    <td class="border px-3 py-2">{{ $s->descripcion }}</td>
                    <td class="border px-3 py-2">$ {{ number_format($s->precio, 2) }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="editar({{ $s->id }})"
                            class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</button>

                        <button wire:click="eliminar({{ $s->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        No hay servicios aún.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $servicios->links() }}

    <!-- MODAL -->
    @if($modal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-96">

                <h3 class="text-xl font-bold mb-4">
                    {{ $servicio_id ? 'Editar Servicio' : 'Nuevo Servicio' }}
                </h3>

                <div class="mb-3">
                    <label>Nombre</label>
                    <input wire:model="nombre" type="text"
                        class="w-full border px-3 py-2 rounded">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea wire:model="descripcion"
                        class="w-full border px-3 py-2 rounded"></textarea>
                </div>

                <div class="mb-3">
                    <label>Precio</label>
                    <input wire:model="precio" type="number" step="0.01"
                        class="w-full border px-3 py-2 rounded">
                    @error('precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button wire:click="cerrarModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2">
                        Cancelar
                    </button>

                    <button wire:click="guardar"
                        class="px-4 py-2 bg-green-600 text-white rounded">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
