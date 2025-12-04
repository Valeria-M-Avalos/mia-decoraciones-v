<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <!-- BOTÓN MOBILE -->
    <div class="lg:hidden p-4 bg-zinc-900 text-white flex items-center justify-between">
        <span class="text-xl font-semibold">Mi Sistema</span>

        <!-- Toggle Button -->
        <button onclick="toggleSidebar()" class="text-white text-2xl">
            ☰
        </button>
    </div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-zinc-900 text-white h-screen fixed top-0 left-0 
               flex flex-col shadow-lg transform -translate-x-full 
               lg:translate-x-0 transition-transform duration-300">

        <!-- LOGO (solo escritorio) -->
        <div class="hidden lg:block p-4 text-center text-xl font-bold bg-zinc-800 border-b border-zinc-700">
            Mi Sistema
        </div>

        <!-- MENÚ -->
        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-zinc-700 
                  @if(request()->routeIs('dashboard')) bg-zinc-700 @endif">
                Inicio
            </a>

            <a href="{{ route('clientes.index') }}"
               class="block px-3 py-2 rounded hover:bg-zinc-700 
                  @if(request()->routeIs('clientes.index')) bg-zinc-700 @endif">
                Clientes
            </a>

            <a href="{{ route('servicios.index') }}"
               class="block px-3 py-2 rounded hover:bg-zinc-700 
                  @if(request()->routeIs('servicios.index')) bg-zinc-700 @endif">
                Servicios
            </a>

            <a href="{{ route('eventos.index') }}"
               class="block px-3 py-2 rounded hover:bg-zinc-700 
                  @if(request()->routeIs('eventos.index')) bg-zinc-700 @endif">
                Eventos
            </a>

            <a href="{{ route('reservas.index') }}"
               class="block px-3 py-2 rounded hover:bg-zinc-700 
                  @if(request()->routeIs('reservas.index')) bg-zinc-700 @endif">
                Reservas
            </a>

        </nav>

        <!-- FOOTER USUARIO -->
        <div class="p-4 border-t border-zinc-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded bg-red-600 hover:bg-red-700">
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
