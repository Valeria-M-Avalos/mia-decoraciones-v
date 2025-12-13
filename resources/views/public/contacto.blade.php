@extends('public.layout')

@section('title', 'Contacto - Mía Decoraciones')

@section('content')

<!-- Hero Contacto -->
<section class="py-20 bg-gradient-to-br from-pink-200 via-pink-100 to-yellow-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">
            Hablemos de tu Evento
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Estamos listos para hacer realidad el evento de tus sueños
        </p>
    </div>
</section>

<!-- Formulario y Info de Contacto -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Formulario -->
            <div class="bg-gradient-to-br from-pink-100 to-white rounded-3xl p-8 md:p-12 shadow-xl">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Solicitar Cotización</h2>
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                @endif
                
                <form action="{{ route('contacto.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo *</label>
                        <input type="text" 
                               id="nombre" 
                               name="nombre" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                               placeholder="Tu nombre">
                        @error('nombre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email y Teléfono -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                                   placeholder="tu@email.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-2">Teléfono *</label>
                            <input type="tel" 
                                   id="telefono" 
                                   name="telefono" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                                   placeholder="+54 9 11 XXXX-XXXX">
                            @error('telefono')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Tipo de Evento y Fecha -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tipo_evento" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Evento *</label>
                            <select id="tipo_evento" 
                                    name="tipo_evento" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                                <option value="">Seleccionar...</option>
                                <option value="cumpleaños">Cumpleaños</option>
                                <option value="boda">Boda</option>
                                <option value="xv_años">XV Años</option>
                                <option value="bautizo">Bautizo</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('tipo_evento')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="fecha_evento" class="block text-sm font-semibold text-gray-700 mb-2">Fecha del Evento</label>
                            <input type="date" 
                                   id="fecha_evento" 
                                   name="fecha_evento"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                            @error('fecha_evento')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Mensaje -->
                    <div>
                        <label for="mensaje" class="block text-sm font-semibold text-gray-700 mb-2">Cuéntanos sobre tu evento *</label>
                        <textarea id="mensaje" 
                                  name="mensaje" 
                                  rows="5" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                                  placeholder="Describe tu visión, cantidad de invitados, preferencias..."></textarea>
                        @error('mensaje')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Botón de Enviar -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white py-4 rounded-xl font-semibold text-lg hover:from-pink-600 hover:to-pink-700 transition shadow-lg transform hover:scale-105">
                        Enviar Consulta
                    </button>
                </form>
            </div>
            
            <!-- Información de Contacto -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Información de Contacto</h2>
                    <p class="text-gray-600 text-lg mb-8">
                        Estamos aquí para responder todas tus preguntas y ayudarte a planificar el evento perfecto.
                    </p>
                </div>
                
                <!-- Datos de Contacto -->
                <div class="space-y-6">
                    <!-- WhatsApp -->
                    <div class="flex items-start space-x-4 p-6 bg-gradient-to-br from-green-100 to-white rounded-2xl shadow-md">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📱</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-1">WhatsApp</h3>
                            <p class="text-gray-600">+54 9 370 522-4581</p>
                            <a href="https://wa.me/5491XXXXXXXXX" target="_blank" class="text-green-600 hover:text-green-700 font-medium">Enviar mensaje</a>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start space-x-4 p-6 bg-gradient-to-br from-pink-100 to-white rounded-2xl shadow-md">
                        <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📧</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-1">Email</h3>
                            <p class="text-gray-600">info@miadecoracione.com</p>
                            <a href="mailto:info@miadecoracione.com" class="text-pink-600 hover:text-pink-700 font-medium">Enviar correo</a>
                        </div>
                    </div>
                    
                    <!-- Ubicación -->
                    <div class="flex items-start space-x-4 p-6 bg-gradient-to-br from-blue-100 to-white rounded-2xl shadow-md">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📍</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-1">Ubicación</h3>
                            <p class="text-gray-600">Formosa, Argentina, Barrio 2 de Abril , José María Cabezón, a 20 metros de la Av. Italia</p>
                        </div>
                    </div>
                    
                    <!-- Horarios -->
                    <div class="flex items-start space-x-4 p-6 bg-gradient-to-br from-yellow-100 to-white rounded-2xl shadow-md">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">🕐</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-1">Horarios de Atención</h3>
                            <p class="text-gray-600">Lunes a Viernes: 9:00 - 18:00</p>
                            <p class="text-gray-600">Sábados: 10:00 - 14:00</p>
                        </div>
                    </div>
                </div>
                
                <!-- Redes Sociales -->
                <div class="bg-gradient-to-br from-pink-200 to-yellow-100 rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Síguenos en Redes</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/share/1C1SJrUAgp/" class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white hover:bg-pink-600 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/miadecoraciones.fsa/?igsh=MXI2dm1mc2J3a2huNg%3D%3D#" class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white hover:bg-pink-600 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection