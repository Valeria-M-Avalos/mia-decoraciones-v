@extends('public.layout')

@section('title', $evento['titulo'] . ' - Mía Decoraciones')

@section('content')

<section class="relative py-32 bg-gradient-to-br from-pink-100 via-pink-50 to-yellow-50 overflow-hidden">
    <div class="absolute inset-0 bg-[length:200%_200%] animate-pulse-slow" style="background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
        <div class="text-9xl mb-6 animate-pulse">{{ $evento['emoji'] }}</div>
        <h1 class="text-6xl md:text-7xl font-extrabold text-gray-800 mb-6 tracking-tight">
            {{ $evento['titulo'] }}
        </h1>
        <p class="text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed font-light">
            {{ $evento['descripcion'] }}
        </p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="zoom-in" data-aos-duration="1000">
        <div class="bg-gradient-to-br from-pink-50 to-white rounded-3xl p-14 shadow-2xl border border-pink-100 transform hover:scale-[1.01] transition-transform duration-300">
            <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center border-b-2 border-pink-200 pb-3">Nuestra Visión</h2>
            <p class="text-xl text-gray-700 leading-relaxed italic text-center">
                “{{ $evento['historia'] }}”
            </p>
        </div>
    </div>
</section>

@if($imagenes->count() > 0)
<section class="py-24 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-down">
            <h2 class="text-5xl font-bold text-gray-800 mb-4">Galería de {{ $evento['titulo'] }}</h2>
            <p class="text-xl text-gray-600">Algunas de nuestras decoraciones más especiales</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($imagenes as $imagen)
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <img src="{{ asset('storage/' . $imagen->imagen) }}" 
                     alt="{{ $imagen->titulo }}" 
                     class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end">
                    <div class="p-6 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="text-white text-2xl font-bold mb-1">{{ $imagen->titulo }}</h3>
                        @if($imagen->descripcion)
                        <p class="text-pink-200 text-sm">{{ $imagen->descripcion }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-3xl p-12 shadow-lg">
            <div class="text-6xl mb-4">📸</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">¡Pronto más fotos!</h3>
            <p class="text-gray-600">Estamos preparando una hermosa galería para mostrarte nuestros trabajos.</p>
        </div>
    </div>
</section>
@endif

@php
    // Filtramos las imágenes que tienen un código de incrustación O un archivo de video subido
    $videos = $imagenes->filter(fn($img) => !empty($img->embed_code_instagram) || !empty($img->archivo_video));
@endphp

@if($videos->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-down">
            <h2 class="text-5xl font-bold text-gray-800 mb-4">Videos e Historias de {{ $evento['titulo'] }}</h2>
            <p class="text-xl text-gray-600">Mira nuestros trabajos en movimiento.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-center">
            @foreach($videos as $video)
            <div class="w-full max-w-sm rounded-3xl overflow-hidden shadow-2xl transition-shadow duration-300 hover:shadow-3xl" data-aos="flip-up" data-aos-delay="{{ $loop->iteration * 150 }}">

                @if(!empty($video->embed_code_instagram))
                    {!! $video->embed_code_instagram !!}

                @elseif(!empty($video->archivo_video))
                    <video controls class="w-full rounded-3xl" poster="{{ asset('storage/' . $video->imagen) }}">
                        <source src="{{ asset('storage/' . $video->archivo_video) }}" type="video/mp4">
                        Tu navegador no soporta el tag de video HTML5.
                    </video>
                @endif
                
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@if($servicios->count() > 0)
<section class="py-24 bg-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-down">
            <h2 class="text-5xl font-bold text-gray-800 mb-4">Servicios Disponibles</h2>
            <p class="text-xl text-gray-600">Paquetes diseñados para hacer tu evento perfecto</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($servicios as $servicio)
            <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all border border-pink-100 transform hover:scale-[1.02]" data-aos="{{ $loop->iteration % 2 == 0 ? 'fade-left' : 'fade-right' }}" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mb-6 mx-auto shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-3 text-center">{{ $servicio->nombre }}</h3>
                
                @if($servicio->descripcion)
                <p class="text-gray-600 mb-6 text-center">{{ $servicio->descripcion }}</p>
                @endif
                
                @if($servicio->precio)
                <div class="text-center pt-4 border-t border-pink-200">
                    <p class="text-sm text-gray-500 mb-1">Desde</p>
                    <p class="text-3xl font-bold text-pink-600">${{ number_format($servicio->precio, 2) }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <p class="text-gray-600 text-lg mb-6">* Los precios pueden variar según tus necesidades específicas</p>
            <a href="{{ route('contacto') }}" class="inline-block bg-gradient-to-r from-pink-500 to-pink-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-pink-700 transition shadow-xl">
                Solicitar Cotización Personalizada
            </a>
        </div>
    </div>
</section>
@endif

<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-12 text-white text-center shadow-2xl transform hover:scale-105 transition-transform duration-300" data-aos="flip-left" data-aos-duration="1500">
            <div class="text-6xl mb-6">👥</div>
            <h2 class="text-4xl font-bold mb-4">Eventos Hasta 60 Personas</h2>
            <p class="text-xl text-pink-100 mb-8">
                Nos especializamos en eventos íntimos donde cada detalle marca la diferencia
            </p>
            <a href="{{ route('contacto') }}" class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                Consultar Disponibilidad
            </a>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in" data-aos-delay="300">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">
            ¿Lista para tu {{ $evento['titulo'] }} Soñado?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Contáctanos y comencemos a planificar juntos el evento perfecto
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contacto') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-pink-700 transition shadow-xl">
                Solicitar Cotización
            </a>
            <a href="{{ route('servicios.publicos') }}" class="bg-white text-pink-600 border-2 border-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-pink-50 transition shadow-lg">
                Ver Otros Eventos
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script async defer src="//www.instagram.com/embed.js"></script>
@endsection