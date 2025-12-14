@extends('public.layout')

@section('title', $evento['titulo'] . ' - Mía Decoraciones')

@section('content')

<!-- Hero Section Mejorado -->
<section class="relative py-32 bg-gradient-to-br from-pink-200 via-white to-yellow-100 overflow-hidden">
    <!-- Patrón de fondo -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #ec4899 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <!-- Elementos decorativos -->
    <div class="absolute top-20 left-20 w-32 h-32 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>
    <div class="absolute top-40 right-20 w-40 h-40 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="animate-fade-in-up">
            <!-- Emoji grande -->
            <div class="text-8xl mb-8 animate-float">{{ $evento['emoji'] }}</div>
            
            <!-- Título -->
            <h1 class="text-6xl md:text-7xl font-bold text-gray-800 mb-6 leading-tight tracking-tight">
                {{ $evento['titulo'] }}
            </h1>
            
            <!-- Descripción -->
            <p class="text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed font-light mb-8">
                {{ $evento['descripcion'] }}
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contacto') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Cotizar Este Evento
                </a>
                <a href="{{ route('servicios.publicos') }}" 
                   class="inline-flex items-center gap-2 bg-white text-pink-600 border-2 border-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-pink-50 transition-all shadow-lg">
                    Ver Otros Eventos
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Historia del Evento -->
<section class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-pink-50 to-white rounded-3xl p-12 md:p-16 shadow-2xl border border-pink-100">
            <div class="flex items-center justify-center mb-8">
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-pink-400 to-transparent"></div>
                <span class="mx-4 text-pink-600 font-semibold text-sm uppercase tracking-wider">Nuestra Visión</span>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-pink-400 to-transparent"></div>
            </div>
            
            <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center">
                {{ $evento['titulo'] }} Inolvidables
            </h2>
            
            <p class="text-xl text-gray-700 leading-relaxed text-center italic">
                "{{ $evento['historia'] }}"
            </p>
        </div>
    </div>
</section>

<!-- Lo que Incluimos -->
@if(isset($evento['detalles']) && count($evento['detalles']) > 0)
<section class="py-24 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Servicios Incluidos</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">
                Lo que Hacemos Por Ti
            </h2>
            <p class="text-xl text-gray-600">Cada detalle pensado para hacer tu evento perfecto</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($evento['detalles'] as $index => $detalle)
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold group-hover:scale-110 transition-transform">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1">
                        <p class="text-lg text-gray-800 font-medium group-hover:text-pink-600 transition-colors">
                            {{ $detalle }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Galería de Imágenes -->
@if($imagenes->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Portfolio</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">
                Galería de {{ $evento['titulo'] }}
            </h2>
            <p class="text-xl text-gray-600">Algunos de nuestros trabajos más especiales</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($imagenes as $imagen)
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3">
                <div class="aspect-w-4 aspect-h-3 relative overflow-hidden">
                    <img src="{{ $imagen->imagen_url }}"
                         alt="{{ $imagen->titulo }}"
                         class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy">
                    
                    <!-- Overlay con información -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end">
                        <div class="p-6 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-white text-2xl font-bold mb-2">{{ $imagen->titulo }}</h3>
                            @if($imagen->descripcion)
                            <p class="text-pink-200 text-sm">{{ $imagen->descripcion }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Badge de categoría -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="bg-white/90 backdrop-blur-sm text-pink-600 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ ucfirst(str_replace('_', ' ', $imagen->categoria)) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-gradient-to-br from-pink-50 to-white rounded-3xl p-12 shadow-lg">
            <div class="text-7xl mb-6">📷</div>
            <h3 class="text-3xl font-bold text-gray-800 mb-4">¡Pronto más fotos!</h3>
            <p class="text-xl text-gray-600 mb-8">
                Estamos preparando una hermosa galería de {{ $evento['titulo'] }} para mostrarte nuestros trabajos.
            </p>
            <a href="{{ route('contacto') }}" 
               class="inline-block bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg">
                Consulta Sobre Este Evento
            </a>
        </div>
    </div>
</section>
@endif

<!-- Videos e Historias -->
@php
    $videos = $imagenes->filter(fn($img) => !empty($img->embed_code_instagram) || !empty($img->archivo_video));
@endphp

@if($videos->count() > 0)
<section class="py-24 bg-gradient-to-br from-pink-100 to-yellow-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">En Movimiento</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">
                Videos de {{ $evento['titulo'] }}
            </h2>
            <p class="text-xl text-gray-600">Mira nuestros trabajos cobrar vida</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-center">
            @foreach($videos as $video)
            <div class="w-full max-w-sm bg-white rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="aspect-w-9 aspect-h-16 bg-gray-100">
                    @if(!empty($video->embed_code_instagram))
                        <div class="w-full h-full flex items-center justify-center p-4">
                            {!! $video->embed_code_instagram !!}
                        </div>
                    @elseif(!empty($video->archivo_video))
                        <video controls class="w-full h-full object-cover" poster="{{ $video->imagen_url }}">
                            <source src="{{ asset('storage/' . $video->archivo_video) }}" type="video/mp4">
                            Tu navegador no soporta el tag de video HTML5.
                        </video>
                    @endif
                </div>
                
                @if($video->titulo || $video->descripcion)
                <div class="p-6">
                    @if($video->titulo)
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $video->titulo }}</h3>
                    @endif
                    @if($video->descripcion)
                    <p class="text-gray-600">{{ $video->descripcion }}</p>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Servicios Disponibles -->
@if($servicios->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Nuestros Paquetes</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 mt-2">
                Servicios Disponibles
            </h2>
            <p class="text-xl text-gray-600">Paquetes diseñados para hacer tu evento perfecto</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($servicios as $servicio)
            <div class="group bg-gradient-to-br from-white to-pink-50 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-pink-100 transform hover:scale-105">
                <!-- Ícono -->
                <div class="w-16 h-16 bg-gradient-to-br from-pink-200 to-pink-200 rounded-full flex items-center justify-center mb-6 mx-auto shadow-lg group-hover:scale-110 transition-transform">
                    @if($servicio->icono)
                    <span class="text-3xl">{{ $servicio->icono }}</span>
                    @else
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @endif
                </div>

                <!-- Nombre -->
                <h3 class="text-2xl font-bold text-gray-800 mb-3 text-center group-hover:text-pink-600 transition-colors">
                    {{ $servicio->nombre }}
                </h3>

                <!-- Descripción -->
                @if($servicio->descripcion)
                <p class="text-gray-600 mb-6 text-center leading-relaxed">
                    {{ $servicio->descripcion }}
                </p>
                @endif

                <!-- Precio -->
                @if($servicio->precio)
                <div class="text-center pt-6 border-t border-pink-200">
                    <p class="text-sm text-gray-500 mb-1">Desde</p>
                    <p class="text-3xl font-bold text-pink-600">${{ number_format($servicio->precio, 2) }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <p class="text-gray-600 text-lg mb-6">* Los precios pueden variar según tus necesidades específicas</p>
            <a href="{{ route('contacto') }}" 
               class="inline-block bg-gradient-to-r from-pink-500 to-pink-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-xl transform hover:scale-105">
                Solicitar Cotización Personalizada
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Capacidad -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-12 text-white text-center shadow-2xl transform hover:scale-105 transition-transform duration-300 relative overflow-hidden">
            <!-- Decoración -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>

            <div class="relative z-10">
                <div class="text-6xl mb-6">👥</div>
                <h2 class="text-4xl font-bold mb-4">Eventos Hasta 60 Personas</h2>
                <p class="text-xl text-pink-100 mb-8 max-w-2xl mx-auto">
                    Nos especializamos en eventos íntimos donde cada detalle marca la diferencia
                </p>
                <a href="{{ route('contacto') }}" 
                   class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg transform hover:scale-105">
                    Consultar Disponibilidad
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
            ¿Lista para tu {{ $evento['titulo'] }} Soñado?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Contáctanos y comencemos a planificar juntos el evento perfecto
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contacto') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-xl transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Solicitar Cotización
            </a>
            <a href="{{ route('servicios.publicos') }}" 
               class="inline-flex items-center gap-2 bg-white text-pink-600 border-2 border-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-pink-50 transition-all shadow-lg">
                Ver Otros Eventos
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script async defer src="//www.instagram.com/embed.js"></script>
@endpush