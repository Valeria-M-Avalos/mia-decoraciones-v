<x-layouts.app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- Tarjetas superiores --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="summary-card">
                <h2 class="text-xl font-semibold text-gray-700">Total Eventos</h2>
                <p class="text-3xl font-bold mt-2 text-pink-600">
                    {{ $totalEventos ?? 0 }}
                </p>
            </div>

            <div class="summary-card">
                <h2 class="text-xl font-semibold text-gray-700">Eventos Pendientes</h2>
                <p class="text-3xl font-bold mt-2 text-pink-600">
                    {{ $eventosPendientes ?? 0 }}
                </p>
            </div>

            <div class="summary-card">
                <h2 class="text-xl font-semibold text-gray-700">Clientes Registrados</h2>
                <p class="text-3xl font-bold mt-2 text-pink-600">
                    {{ $totalClientes ?? 0 }}
                </p>
            </div>
        </div>

        {{-- Tabla o gráfico grande --}}
        <div class="tasks-card">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Eventos próximos</h2>

            @if(isset($proximosEventos) && count($proximosEventos) > 0)
                <div class="flex flex-col gap-3">
                    @foreach ($proximosEventos as $ev)
                        <div class="event-card">
                            <h3 class="text-lg font-bold text-gray-800">{{ $ev->titulo }}</h3>
                            <p class="text-gray-600">{{ $ev->fecha }}</p>
                            <p class="text-gray-600">{{ $ev->descripcion }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No hay eventos próximos.</p>
            @endif
        </div>

    </div>

</x-layouts.app>

