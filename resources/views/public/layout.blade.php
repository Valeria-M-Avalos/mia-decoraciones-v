<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mía Decoraciones - Eventos Inolvidables')</title>
    <meta name="description" content="Decoración y organización de eventos especiales: cumpleaños, bodas, XV años y bautizos. Hasta 200 personas.">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-pink-50">
    
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-sm fixed w-full top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Mía Decoraciones" class="h-14">
                </a>
                
                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600 transition font-medium">Inicio</a>
                    <a href="{{ route('servicios.publicos') }}" class="text-gray-700 hover:text-pink-600 transition font-medium">Servicios</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-pink-600 transition font-medium">Contacto</a>
                </div>
                
                <!-- CTA Button -->
                <a href="{{ route('contacto') }}" class="hidden md:block bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 py-2.5 rounded-full hover:from-pink-600 hover:to-pink-700 transition shadow-lg">
                    Cotizar Evento
                </a>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-pink-600 font-medium">Inicio</a>
                <a href="{{ route('servicios.publicos') }}" class="block text-gray-700 hover:text-pink-600 font-medium">Servicios</a>
                <a href="{{ route('contacto') }}" class="block text-gray-700 hover:text-pink-600 font-medium">Contacto</a>
                <a href="{{ route('contacto') }}" class="block bg-pink-500 text-white px-4 py-2 rounded-full text-center">Cotizar Evento</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-pink-600 to-pink-500 text-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo y descripción -->
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="Mía Decoraciones" class="h-16 mb-4 brightness-0">
                    <p class="text-pink-100">Creamos momentos mágicos e inolvidables para tus eventos especiales.</p>
                </div>
                
                <!-- Enlaces -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-pink-100 hover:text-gray-800 transition">Inicio</a></li>
                        <li><a href="{{ route('servicios.publicos') }}" class="text-pink-100 hover:text-gray-800 transition">Servicios</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-pink-100 hover:text-gray-800 transition">Contacto</a></li>
                    </ul>
                </div>
                
                <!-- Contacto -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Contacto</h3>
                    <ul class="space-y-2 text-pink-700">
                        <li>📧 info@miadecoracione.com</li>
                        <li>📱 WhatsApp: +54 9 11 XXXX-XXXX</li>
                        <li>📍 Formosa, Argentina</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-pink-400 mt-8 pt-8 text-center text-pink-700">
                <p>&copy; {{ date('Y') }} Mía Decoraciones. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>