{{-- resources/views/components/layouts/app.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? config('app.name') }}</title>

    {{-- Vite: CSS (y JS si querés) --}}
    @if (config('app.env') !== 'production')
        {{-- en dev con Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- en producción, si compilás a public/css/app.css podrías usar asset() --}}
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    @endif

    {{-- Livewire styles --}}
    @livewireStyles

    {{-- Espacio para estilos adicionales por vista --}}
    @stack('styles')
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    {{-- Componente de sidebar/layout que ya usabas: mantenemos slot, title --}}
    <x-layouts.app.sidebar :title="$title ?? null">
        <div class="p-6">
            {{ $slot }}
        </div>
    </x-layouts.app.sidebar>

    {{-- Livewire scripts --}}
    @livewireScripts

    {{-- Scripts de Vite (si no los incluíste arriba) --}}
    {{-- si no querés duplicar @vite en head, podés incluir solo el JS aquí: --}}
    @if (config('app.env') === 'production')
        <script src="{{ asset('build/assets/app.js') }}"></script>
    @else
        {{-- Vite ya agregó el JS arriba en dev; si prefieres, mueve la llamada aquí --}}
    @endif

    {{-- Espacio para scripts adicionales por vista --}}
    @stack('scripts')
</body>
</html>

