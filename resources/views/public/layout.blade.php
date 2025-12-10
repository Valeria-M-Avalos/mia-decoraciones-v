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
                        <li>📱 WhatsApp: +54 9 370 522-4581</li>
                        <li>📍 Formosa, Argentina, Barrio 2 de Abril , José María Cabezón, a 20 metros de la Av. Italia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-pink-400 mt-8 pt-8 text-center text-pink-700">
                <p>&copy; {{ date('Y') }} Mía Decoraciones. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

     <!-- Botón WhatsApp Flotante -->
    <a href="https://wa.me/5493704123456?text=Hola!%20Quiero%20información%20sobre%20sus%20servicios" 
       target="_blank"
       class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center group">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
        <span class="absolute right-full mr-3 bg-gray-800 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">
            ¡Hablemos por WhatsApp!
        </span>
    </a>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>