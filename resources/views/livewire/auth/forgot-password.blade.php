<x-layouts.auth>
    <div class="mia-card p-8 w-full max-w-[420px] mx-auto">
        
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Recuperar Contraseña</h2>
            <p class="text-sm text-gray-500 mt-2 text-left">
                ¿Olvidaste tu contraseña? No hay problema. Dinos tu correo electrónico y te enviaremos un enlace para elegir una nueva.
            </p>
        </div>

        <!-- Mensaje de estado de sesión -->
        <x-auth-session-status class="mb-4 text-center text-green-600 font-medium text-sm" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="mia-input" placeholder="ejemplo@correo.com" value="{{ old('email') }}" required autofocus>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mt-2">
                <button type="submit" class="btn-mia-primary w-full py-3 text-base shadow-lg shadow-pink-200">
                    Enviar enlace
                </button>
            </div>
            
            <div class="mt-2 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">
                    Volver al login
                </a>
            </div>
        </form>
    </div>
</x-layouts.auth>