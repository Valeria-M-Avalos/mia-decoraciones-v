@extends('public.layout')

@section('title', 'Servicios - Mía Decoraciones')

@section('content')

<!-- Hero Section -->
<section class="relative py-24 bg-gradient-to-br from-pink-200 via-white to-yellow-100 overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #ec4899 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 tracking-tight">
            Nuestros Servicios
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Creamos experiencias únicas y memorables para eventos de hasta 60 personas
        </p>
    </div>
</section>

<!-- Tipos de Eventos --->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tipos de Eventos</h2>
            <p class="text-xl text-gray-600">Especializados en celebraciones íntimas y especiales</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($tiposEventos as $tipo)
            <a href="{{ route('eventos.detalle', ['tipo' => $tipo['slug']]) }}" 
               class="group relative block overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                
                <!-- Imagen de fondo -->
                <div class="relative h-80 overflow-hidden">
                    @if(isset($imagenesPorTipo[$tipo['slug']]) && $imagenesPorTipo[$tipo['slug']])
                        <img src="{{ $imagenesPorTipo[$tipo['slug']]->imagen_url }}"
                             alt="{{ $tipo['nombre'] }}"
                             class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:blur-sm">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-pink-200 to-pink-300"></div>
                    @endif
                    
                    <!-- Overlay oscuro en hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-500"></div>
                    
                    <!-- Contenido -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
                        <!-- Emoji/Icono que aparece en hover -->
                        <div class="transform transition-all duration-500 group-hover:scale-125">
                            <span class="text-7xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 filter drop-shadow-2xl">
                                {{ $tipo['emoji'] }}
                            </span>
                        </div>
                        
                        <!-- Título siempre visible -->
                        <h3 class="text-3xl font-bold text-white mb-3 transform transition-all duration-500 group-hover:-translate-y-4">
                            {{ $tipo['nombre'] }}
                        </h3>
                        
                        <!-- Descripción que aparece en hover -->
                        <p class="text-white text-center opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                            {{ $tipo['descripcion'] }}
                        </p>
                        
                        <!-- Botón "Ver más" -->
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">
                            <span class="inline-flex items-center text-white font-semibold border-b-2 border-white pb-1">
                                Más información
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Servicios Disponibles -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">¿Qué Incluyen Nuestros Servicios?</h2>
            <p class="text-xl text-gray-600">Todo lo que necesitas para tu evento perfecto</p>
        </div>

        @if($servicios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($servicios as $servicio)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <!-- Imagen o ícono -->
                <div class="relative h-48 bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center overflow-hidden">
                    @if($servicio->imagen_url)
                        <img src="{{ $servicio->imagen_url }}" 
                             alt="{{ $servicio->nombre }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <span class="text-7xl transform group-hover:scale-125 transition-transform duration-500">
                            {{ $servicio->icono ?? '✨' }}
                        </span>
                    @endif
                    
                    <!-- Badge de categoría -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-white/90 backdrop-blur-sm text-pink-600 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ ucfirst($servicio->categoria) }}
                        </span>
                    </div>
                </div>
                
                <!-- Contenido -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-pink-600 transition-colors">
                        {{ $servicio->nombre }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $servicio->descripcion }}
                    </p>
                    
                    @if($servicio->precio)
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Desde</p>
                            <p class="text-2xl font-bold text-pink-600">
                                ${{ number_format($servicio->precio, 2) }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🎨</div>
            <p class="text-xl text-gray-600">Contáctanos para conocer nuestros paquetes personalizados</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Capacidad -->
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-12 text-white text-center shadow-2xl relative overflow-hidden">
            <!-- Decoración de fondo -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10">
                <div class="text-6xl mb-6">👥</div>
                <h2 class="text-4xl font-bold mb-4">Eventos para Hasta 60 Personas</h2>
                <p class="text-xl text-pink-100 mb-8 max-w-2xl mx-auto">
                    Nos especializamos en eventos íntimos y personalizados donde cada detalle cuenta
                </p>
                <a href="{{ route('contacto') }}" 
                   class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg transform hover:scale-105">
                    Consultar Disponibilidad
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Proceso -->
<section class="py-20 bg-gradient-to-br from-pink-100 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Nuestro Proceso</h2>
            <p class="text-xl text-gray-600">Simple, personalizado y sin complicaciones</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @php
            $pasos = [
                ['numero' => '1', 'titulo' => 'Consulta', 'descripcion' => 'Conversamos sobre tu visión y necesidades'],
                ['numero' => '2', 'titulo' => 'Propuesta', 'descripcion' => 'Diseñamos una propuesta personalizada'],
                ['numero' => '3', 'titulo' => 'Planificación', 'descripcion' => 'Coordinamos cada detalle del evento'],
                ['numero' => '4', 'titulo' => '¡Tu Evento!', 'descripcion' => 'Disfrutá de un día perfecto'],
            ];
            @endphp
            
            @foreach($pasos as $index => $paso)
            <div class="relative text-center group">
                <!-- Línea conectora -->
                @if($index < 3)
                <div class="hidden md:block absolute top-10 left-1/2 w-full h-0.5 bg-pink-200 z-0">
                    <div class="h-full bg-pink-500 transition-all duration-1000 group-hover:w-full" style="width: 0%"></div>
                </div>
                @endif
                
                <!-- Círculo con número -->
                <div class="relative z-10 w-20 h-20 mx-auto bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mb-4 shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12">
                    {{ $paso['numero'] }}
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $paso['titulo'] }}</h3>
                <p class="text-gray-600">{{ $paso['descripcion'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 bg-gradient-to-r from-pink-500 to-pink-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Comenzamos a Planificar?</h2>
        <p class="text-xl mb-8 text-pink-100">Contáctanos para una cotización personalizada y sin compromiso</p>
        <a href="{{ route('contacto') }}" 
           class="inline-block bg-white text-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-xl transform hover:scale-105">
            Solicitar Cotización Gratis
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Animación de las líneas de proceso
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const line = entry.target.querySelector('.bg-pink-500');
                if (line) {
                    line.style.width = '100%';
                }
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.grid .group').forEach(el => observer.observe(el));
});
</script>
@endpush