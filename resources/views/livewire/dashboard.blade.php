<div class="space-y-8 font-sans text-gray-700">

    {{-- ============================
         RESUMEN GENERAL
       ============================ --}}
    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Tarjeta Clientes -->
        <div class="mia-card flex flex-col items-start justify-center hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-medium text-gray-500 mb-1">Clientes</h3>
            <p class="text-3xl font-bold text-[#FF5A79]">{{ $totalClientes }}</p>
        </div>

        <!-- Tarjeta Reservas -->
        <div class="mia-card flex flex-col items-start justify-center hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-medium text-gray-500 mb-1">Reservas</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalReservas }}</p>
        </div>

        <!-- Tarjeta Eventos -->
        <div class="mia-card flex flex-col items-start justify-center hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-medium text-gray-500 mb-1">Eventos</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalEventos }}</p>
        </div>

        <!-- Tarjeta Servicios -->
        <div class="mia-card flex flex-col items-start justify-center hover:shadow-lg transition-shadow">
            <h3 class="text-sm font-medium text-gray-500 mb-1">Servicios</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalServicios }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- ============================
             PRÓXIMOS EVENTOS
           ============================ --}}
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Próximos eventos</h2>

            @if($proximosEventos && $proximosEventos->count())
                <div class="space-y-4">
                    @foreach($proximosEventos as $evento)
                        <div class="mia-card p-5 !py-4 flex flex-col gap-1 hover:shadow-md transition-shadow border-l-4 border-l-[#FF5A79]">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $evento->nombre }}</h3>
                                <span class="text-xs font-semibold bg-pink-50 text-pink-600 px-2 py-1 rounded-full">
                                    {{ $evento->fecha }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500">
                                Cliente: <strong class="text-gray-700">{{ $evento->cliente }}</strong>
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mia-card text-center text-gray-400 py-8">
                    No hay eventos próximos.
                </div>
            @endif
        </div>

        {{-- ============================
             ACTIVIDADES RECIENTES
           ============================ --}}
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Actividad reciente</h2>
            <div class="mia-card">
                @if($actividadReciente && count($actividadReciente))
                    <ul class="space-y-4">
                        @foreach($actividadReciente as $log)
                            <li class="flex items-start justify-between border-b border-gray-50 last:border-0 pb-3 last:pb-0">
                                <div class="flex items-center gap-3">
                                    <!-- Punto indicador rosa -->
                                    <div class="w-2 h-2 rounded-full bg-[#FF5A79]"></div>
                                    <span class="text-sm text-gray-700">{{ $log['texto'] }}</span>
                                </div>
                                <span class="text-xs text-gray-400 whitespace-nowrap ml-2">{{ $log['fecha'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">No hay actividad reciente.</p>
                @endif
            </div>
        </div>
    </div>
</div>
