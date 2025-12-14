<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <!-- Asegúrate de tener Tailwind CSS cargado para que las clases funcionen -->
</head>

<!-- El cuerpo ahora tiene el fondo principal blanco o gris muy claro -->
<body class="min-h-screen bg-gray-50 dark:bg-zinc-800 text-zinc-800 dark:text-gray-100">

    <!-- BOTÓN MOBILE: Fondo más fuerte para contraste (ROSE-500) -->
    <div class="lg:hidden p-4 bg-rose-500 text-white flex items-center justify-between">
        <span class="text-xl font-semibold">Mi Sistema</span>

        <!-- Toggle Button -->
        <button onclick="toggleSidebar()" class="text-white text-2xl">
            ☰
        </button>
    </div>

    <!-- SIDEBAR: Fondo de Rosa Pastel (ROSE-50) y texto contrastante (ROSE-900) -->
    <aside id="sidebar"
        class="w-64 bg-rose-50 text-rose-900 h-screen fixed top-0 left-0 
               flex flex-col shadow-xl transform -translate-x-full 
               lg:translate-x-0 transition-transform duration-300 border-r border-rose-100">

        <!-- LOGO (solo escritorio): Fondo ligeramente más oscuro que el sidebar (ROSE-100) -->
        <div class="hidden lg:block p-4 text-center text-xl font-bold bg-rose-100 border-b border-rose-200">
            Mi Sistema
        </div>

        <!-- MENÚ -->
        <nav class="flex-1 p-4 space-y-1">

            <!-- INICIO (APLICACIÓN DE ESTILO SELECCIONADO: bg-rose-200 y borde ROSE-400) -->
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded transition duration-150 ease-in-out
                       hover:bg-rose-100 hover:text-rose-800 
                       @if(request()->routeIs('dashboard')) 
                           bg-rose-200 border-l-4 border-rose-400 font-semibold text-rose-900
                       @endif">
                Inicio
            </a>

            <!-- CLIENTES -->
            <a href="{{ route('clientes.index') }}"
                class="block px-3 py-2 rounded transition duration-150 ease-in-out
                       hover:bg-rose-100 hover:text-rose-800
                       @if(request()->routeIs('clientes.index')) 
                           bg-rose-200 border-l-4 border-rose-400 font-semibold text-rose-900
                       @endif">
                Clientes
            </a>

            <!-- SERVICIOS -->
            <a href="{{ route('servicios.index') }}"
                class="block px-3 py-2 rounded transition duration-150 ease-in-out
                       hover:bg-rose-100 hover:text-rose-800
                       @if(request()->routeIs('servicios.index')) 
                           bg-rose-200 border-l-4 border-rose-400 font-semibold text-rose-900
                       @endif">
                Servicios
            </a>

            <!-- EVENTOS -->
            <a href="{{ route('eventos.index') }}"
                class="block px-3 py-2 rounded transition duration-150 ease-in-out
                       hover:bg-rose-100 hover:text-rose-800
                       @if(request()->routeIs('eventos.index')) 
                           bg-rose-200 border-l-4 border-rose-400 font-semibold text-rose-900
                       @endif">
                Eventos
            </a>

            <!-- RESERVAS -->
            <a href="{{ route('reservas.index') }}"
                class="block px-3 py-2 rounded transition duration-150 ease-in-out
                       hover:bg-rose-100 hover:text-rose-800
                       @if(request()->routeIs('reservas.index')) 
                           bg-rose-200 border-l-4 border-rose-400 font-semibold text-rose-900
                       @endif">
                Reservas
            </a>

        </nav>

        <!-- FOOTER USUARIO -->
        <div class="p-4 border-t border-rose-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!-- Botón de Logout más vibrante (ROSE-500) -->
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded bg-rose-500 hover:bg-rose-600 text-white font-semibold shadow-md">
                    Cerrar sesión
                </button>
            </form>
        </div>

    </aside>

    <!-- CONTENIDO -->
    <div class="lg:ml-64 p-6">
        {{ $slot }}
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    @fluxScripts
</body>
</html>