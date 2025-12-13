@extends('public.layout')

@section('title', 'Inicio - Mía Decoraciones')

@section('content')

<!-- Hero Section Mejorado -->
<section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 via-white to-yellow-100 overflow-hidden">
    <!-- Animación de partículas sutiles -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 -top-48 -left-48 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute w-96 h-96 -top-48 -right-48 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute w-96 h-96 -bottom-48 left-1/2 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Elementos decorativos flotantes -->

    <div class="absolute top-20 left-10 animate-float animation-delay-2000">
        <svg class="w-20 h-20 text-yellow-400 opacity-50" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
    </div>

    <div class="absolute bottom-20 right-20 animate-float animation-delay-2000">
            <svg class="w-16 h-16 text-pink-600 opacity-40" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        </div>

    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <div class="animate-fade-in-up">
            <h1 class="text-6xl md:text-8xl font-bold text-gray-800 mb-6 leading-tight">
                Convierte tus Sueños en
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-pink-600 to-pink-500 animate-gradient">
                    Realidad
                </span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Decoración y organización de eventos mágicos e inolvidables.
                Desde cumpleaños hasta bodas, hacemos realidad cada detalle.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('servicios.publicos') }}" 
                   class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-pink-500 to-pink-600 rounded-full overflow-hidden shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <span class="relative z-10 flex items-center">
                        Ver Servicios
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-pink-700 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                </a>

                <a href="{{ route('contacto') }}" 
                   class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-pink-600 bg-white border-2 border-pink-600 rounded-full shadow-lg hover:bg-pink-50 transform hover:scale-105 transition-all duration-300">
                    Contactar Ahora
                    <svg class="w-5 h-5 ml-2 transform group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Stats o números -->
        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
            @php
            $stats = [
                ['numero' => '500+', 'texto' => 'Eventos Realizados'],
                ['numero' => '60', 'texto' => 'Capacidad Máxima'],
                ['numero' => '10+', 'texto' => 'Años de Experiencia'],
                ['numero' => '100%', 'texto' => 'Satisfacción'],
            ];
            @endphp
            
            @foreach($stats as $stat)
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-4xl md:text-5xl font-bold text-pink-600 mb-2">{{ $stat['numero'] }}</div>
                <div class="text-sm md:text-base text-gray-600">{{ $stat['texto'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Tipos de Eventos -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Lo que hacemos</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">Eventos que Organizamos</h2>
            <p class="text-xl text-gray-600">Especialistas en crear momentos inolvidables</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $tiposEventos = [
                ['emoji' => '🎂', 'titulo' => 'Cumpleaños', 'descripcion' => 'Celebraciones únicas para todas las edades'],
                ['emoji' => '💒', 'titulo' => 'Casamiento', 'descripcion' => 'El día más especial de tu vida'],
                ['emoji' => '👑', 'titulo' => 'XV Años', 'descripcion' => 'Quinceañeras de ensueño'],
                ['emoji' => '🎉', 'titulo' => 'Otros Eventos', 'descripcion' => 'Eventos a medida creados por vos'],
            ];
            @endphp
            
            @foreach($tiposEventos as $evento)
            <div class="group bg-gradient-to-br from-pink-50 to-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3">
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative w-full h-full bg-white rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-500">
                        <span class="text-5xl">{{ $evento['emoji'] }}</span>
                    </div>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-pink-600 transition-colors">
                    {{ $evento['titulo'] }}
                </h3>
                <p class="text-gray-600">{{ $evento['descripcion'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Por qué elegirnos -->
<section class="py-24 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Nuestra ventaja</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">¿Por Qué Elegirnos?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $razones = [
                ['emoji' => '🎨', 'titulo' => 'Experiencia', 'descripcion' => 'Años de experiencia creando eventos inolvidables que superan expectativas'],
                ['emoji' => '💖', 'titulo' => 'Atención Personalizada', 'descripcion' => 'Cada detalle diseñado especialmente para ti y tu visión única'],
                ['emoji' => '👥', 'titulo' => 'Hasta 60 Personas', 'descripcion' => 'Eventos íntimos y acogedores donde cada invitado es especial'],
            ];
            @endphp
            
            @foreach($razones as $razon)
            <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden">
                <!-- Efecto hover de fondo -->
                <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-pink-600 transform scale-0 group-hover:scale-100 transition-transform duration-500 origin-bottom-right rounded-3xl"></div>
                
                <!-- Contenido -->
                <div class="relative z-10">
                    <div class="text-6xl mb-6 transform group-hover:scale-110 transition-transform duration-500">
                        {{ $razon['emoji'] }}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-white mb-4 transition-colors">
                        {{ $razon['titulo'] }}
                    </h3>
                    <p class="text-gray-600 group-hover:text-pink-100 transition-colors">
                        {{ $razon['descripcion'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Galería destacada -->
@if(isset($imagenesDestacadas) && $imagenesDestacadas->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Portfolio</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">Nuestros Trabajos</h2>
            <p class="text-xl text-gray-600">Algunos de nuestros eventos más especiales</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($imagenesDestacadas as $imagen)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <img src="{{ asset('storage/galeria/' . $imagen->imagen) }}" 
                     alt="{{ $imagen->titulo }}"
                     class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end">
                    <div class="p-6 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="text-white text-xl font-bold mb-1">{{ $imagen->titulo }}</h3>
                        @if($imagen->descripcion)
                        <p class="text-pink-200 text-sm">{{ $imagen->descripcion }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('servicios.publicos') }}" 
               class="inline-flex items-center text-pink-600 font-semibold hover:text-pink-700 transition-colors group">
                Ver más trabajos
                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Final -->
<section class="py-24 bg-gradient-to-r from-pink-500 to-pink-600 text-white relative overflow-hidden">
    <!-- Patrón de fondo -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Listo para tu Evento Soñado?</h2>
        <p class="text-xl mb-10 text-pink-100">Contáctanos y comencemos a planificar juntos el día perfecto</p>
        
        <a href="{{ route('contacto') }}" 
           class="inline-block bg-white text-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-2xl transform hover:scale-105">
            Solicitar Cotización
        </a>
        
        <div class="mt-10 flex items-center justify-center gap-8 text-pink-100">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Sin compromiso</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Respuesta rápida</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Asesoramiento gratis</span>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(50px, 50px) scale(1.05); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.animate-fade-in-up {
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush