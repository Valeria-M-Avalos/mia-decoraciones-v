@extends('public.layout')

@section('title', 'Inicio - Mía Decoraciones')

@section('content')

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 via-pink-50 to-yellow-50 overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-20 left-10 animate-bounce">
        <svg class="w-16 h-16 text-yellow-400 opacity-60" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-5xl md:text-7xl font-bold text-gray-800 mb-6">
            Convierte tus Sueños en
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-pink-600">Realidad</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Decoración y organización de eventos mágicos e inolvidables. 
            Desde cumpleaños hasta bodas, hacemos realidad cada detalle.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('servicios') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-pink-700 transition shadow-xl transform hover:scale-105">
                Ver Servicios
            </a>
            <a href="{{ route('contacto') }}" class="bg-white text-pink-600 border-2 border-pink-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-pink-50 transition shadow-lg transform hover:scale-105">
                Contactar Ahora
            </a>
        </div>
    </div>
    
    <!-- Decorative star -->
    <div class="absolute bottom-10 right-10">
        <svg class="w-20 h-20 text-pink-400 opacity-40 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
    </div>
</section>

<!-- Tipos de Eventos -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Eventos que Organizamos</h2>
            <p class="text-xl text-gray-600">Especialistas en crear momentos inolvidables</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Cumpleaños -->
            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-3xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-4xl">🎂</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Cumpleaños</h3>
                <p class="text-gray-600">Celebraciones únicas para todas las edades</p>
            </div>
            
            <!-- Bodas -->
            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-3xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-4xl">💍</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Bodas</h3>
                <p class="text-gray-600">El día más especial de tu vida</p>
            </div>
            
            <!-- XV Años -->
            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-3xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-4xl">✨</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">XV Años</h3>
                <p class="text-gray-600">Quinceañeras de ensueño</p>
            </div>
            
            <!-- Bautizos -->
            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-3xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-4xl">🎁</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Bautizos</h3>
                <p class="text-gray-600">Momentos tiernos y especiales</p>
            </div>
        </div>
    </div>
</section>

<!-- Por qué elegirnos -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">¿Por Qué Elegirnos?</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-5xl mb-4">⭐</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Experiencia</h3>
                <p class="text-gray-600">Años de experiencia creando eventos inolvidables</p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-5xl mb-4">💝</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Atención Personalizada</h3>
                <p class="text-gray-600">Cada detalle diseñado especialmente para ti</p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="text-5xl mb-4">👥</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Hasta 200 Personas</h3>
                <p class="text-gray-600">Eventos íntimos y acogedores</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-gradient-to-r from-pink-500 to-pink-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Listo para tu Evento Soñado?</h2>
        <p class="text-xl mb-8">Contáctanos y comencemos a planificar juntos</p>
        <a href="{{ route('contacto') }}" class="inline-block bg-white text-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-xl transform hover:scale-105">
            Solicitar Cotización
        </a>
    </div>
</section>

@endsection