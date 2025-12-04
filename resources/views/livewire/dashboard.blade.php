<x-layouts.app :title="__('Dashboard')">

    <div class="p-6">

        {{-- Título --}}
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        {{-- MÉTRICAS / CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700">Clientes</h2>
                <p class="text-4xl font-bold mt-2">{{ $stats['clientes'] }}</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700">Servicios</h2>
                <p class="text-4xl font-bold mt-2">{{ $stats['servicios'] }}</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700">Eventos</h2>
                <p class="text-4xl font-bold mt-2">{{ $stats['eventos'] }}</p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700">Reservas</h2>
                <p class="text-4xl font-bold mt-2">{{ $stats['reservas'] }}</p>
            </div>

        </div>

        {{-- LISTADO DE PROXIMOS EVENTOS --}}
        <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Próximos eventos</h2>

            @if(count($proximosEventos) === 0)
                <p class="text-gray-500">No hay eventos próximos.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($proximosEventos as $evento)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $evento->titulo }}</p>
                                <p class="text-gray-500 text-sm">
                                    {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                                </p>
                            </div>

                            <a href="{{ route('eventos.index') }}"
                               class="text-blue-600 hover:underline text-sm">
                                Ver evento
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</x-layouts.app>


