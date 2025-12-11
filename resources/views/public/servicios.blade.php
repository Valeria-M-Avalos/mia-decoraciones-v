@extends('public.layout')

@section('title', 'Servicios - Mía Decoraciones')

@section('content')

<section class="py-20 bg-gradient-to-br from-pink-100 via-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">
            Nuestros Servicios
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Creamos experiencias únicas y memorables para eventos de hasta 200 personas
        </p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tipos de Eventos</h2>
            <p class="text-xl text-gray-600">Especializados en celebraciones íntimas y especiales</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($tiposEventos as $tipo)
            
            {{-- INICIO CORRECCIÓN: El <a> ahora envuelve toda la tarjeta --}}
            <a href="{{ route('eventos.detalle', ['tipo' => $tipo['slug']]) }}" 
               class="group relative bg-gradient-to-br from-pink-50 to-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 block">
                
                <div class="h-64 bg-gradient-to-br from-pink-200 to-pink-300 flex items-center justify-center overflow-hidden">
                    @if(isset($imagenesPorTipo[$tipo['slug']]) && $imagenesPorTipo[$tipo['slug']])
                        <img src="{{ $imagenesPorTipo[$tipo['slug']]->imagen_url }}" 
                             alt="{{ $tipo['nombre'] }}" 
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-8xl">
                            @if($tipo['nombre'] == 'Cumpleaños') 🎂
                            @elseif($tipo['nombre'] == 'Bodas') 💍
                            @elseif($tipo['nombre'] == 'XV Años') ✨
                            @elseif($tipo['nombre'] == 'Otros Eventos') 🎁
                            @endif
                        </span>
                    @endif
                </div>
                
                <div class="p-8">
                    <h3 class="text-3xl font-bold text-gray-800 mb-3">{{ $tipo['nombre'] }}</h3>
                    <p class="text-gray-600 text-lg mb-4">{{ $tipo['descripcion'] }}</p>
                    
                    <div class="flex items-center text-pink-600 font-semibold group-hover:translate-x-2 transition">
                        <span>Más información</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
            {{-- FIN CORRECCIÓN --}}
            
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">¿Qué Incluyen Nuestros Servicios?</h2>
        </div>
        
        @if($servicios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($servicios as $servicio)
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $servicio->nombre }}</h3>
                <p class="text-gray-600 mb-4">{{ $servicio->descripcion }}</p>
                <p class="text-2xl font-bold text-pink-600">${{ number_format($servicio->precio, 2) }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-xl text-gray-600">Contáctanos para conocer nuestros paquetes personalizados</p>
        </div>
        @endif
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-12 text-white text-center">
            <div class="text-6xl mb-6">👥</div>
            <h2 class="text-4xl font-bold mb-4">Eventos para Hasta 60 Personas</h2>
            <p class="text-xl text-pink-100 mb-8">
                Nos especializamos en eventos íntimos y personalizados donde cada detalle cuenta
            </p>
            <a href="{{ route('contacto') }}" class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg">
                Consultar Disponibilidad
            </a>
        </div>
    </div>
</section>

<section class="py-20 bg-gradient-to-br from-pink-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Nuestro Proceso</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-pink-500 text-white rounded-full flex items-center justify-center text-3xl font-bold mb-4">1</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Consulta</h3>
                <p class="text-gray-600">Conversamos sobre tu visión y necesidades</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-pink-500 text-white rounded-full flex items-center justify-center text-3xl font-bold mb-4">2</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Propuesta</h3>
                <p class="text-gray-600">Diseñamos una propuesta personalizada</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-pink-500 text-white rounded-full flex items-center justify-center text-3xl font-bold mb-4">3</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Planificación</h3>
                <p class="text-gray-600">Coordinamos cada detalle del evento</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-pink-500 text-white rounded-full flex items-center justify-center text-3xl font-bold mb-4">4</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">¡Tu Evento!</h3>
                <p class="text-gray-600">Disfrutá de un día perfecto</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gradient-to-r from-pink-500 to-pink-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Comenzamos a Planificar?</h2>
        <p class="text-xl mb-8">Contáctanos para una cotización personalizada</p>
        <a href="{{ route('contacto') }}" class="inline-block bg-white text-pink-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-xl">
            Solicitar Cotización Gratis
        </a>
    </div>
</section>

@endsection