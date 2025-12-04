<div class="space-y-8">

    {{-- ============================
         RESUMEN GENERAL
       ============================ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="summary-card">
            <h3 class="text-lg font-semibold text-gray-700">Clientes</h3>
            <p class="text-3xl font-bold text-pink-600">{{ $totalClientes }}</p>
        </div>

        <div class="summary-card">
            <h3 class="text-lg font-semibold text-gray-700">Reservas</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalReservas }}</p>
        </div>

        <div class="summary-card">
            <h3 class="text-lg font-semibold text-gray-700">Eventos</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalEventos }}</p>
        </div>

        <div class="summary-card">
            <h3 class="text-lg font-semibold text-gray-700">Servicios</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalServicios }}</p>
        </div>
    </div>

    {{-- ============================
         PRÓXIMOS EVENTOS
       ============================ --}}
    <div class="tasks-card">
        <h2 class="text-xl font-semibold mb-4">Próximos eventos</h2>

        @if($proximosEventos && $proximosEventos->count())
            <div class="space-y-4">
                @foreach($proximosEventos as $evento)
                    <div class="event-card">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-800">{{ $evento->nombre }}</h3>
                            <span class="text-sm text-gray-500">{{ $evento->fecha }}</span>
                        </div>
                        <p class="text-sm text-gray-600">
                            Cliente: <strong>{{ $evento->cliente }}</strong>
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No hay eventos próximos.</p>
        @endif
    </div>

    {{-- ============================
         ACTIVIDADES RECIENTES
       ============================ --}}
    <div class="tasks-card">
        <h2 class="text-xl font-semibold mb-4">Actividad reciente</h2>

        @if($actividadReciente && count($actividadReciente))
            <ul class="space-y-3">
                @foreach($actividadReciente as $log)
                    <li class="flex items-center justify-between border-b pb-2">
                        <span>{{ $log['texto'] }}</span>
                        <span class="text-xs text-gray-500">{{ $log['fecha'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No hay actividad reciente.</p>
        @endif
    </div>

</div>
