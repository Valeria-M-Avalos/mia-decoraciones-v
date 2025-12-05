<x-layouts.auth>
    <!-- Tarjeta Blanca Centrada (Estilo Mía Decoraciones) -->
    <div class="mia-card p-8 w-full max-w-[420px] mx-auto">
        
        <!-- Encabezado -->
        <div class="flex flex-col gap-2 mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Iniciar Sesión</h2>
            <p class="text-sm text-gray-500">
                Ingrese su correo y contraseña para entrar
            </p>
        </div>

        <!-- Estado de la sesión (Errores generales) -->
        <x-auth-session-status class="mb-4 text-center text-red-500 text-sm" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Correo Electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="email" 
                    placeholder="ejemplo@correo.com"
                    class="mia-input"
                >
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                </div>
                
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••"
                    class="mia-input"
                >

                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mt-2">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-[#FF5A79] focus:ring-[#FF5A79]" style="accent-color: #FF5A79;">
                    <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-500 hover:text-[#FF5A79] underline decoration-transparent hover:decoration-current transition" href="{{ route('password.request') }}" wire:navigate>
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Botón Entrar (Rosa) -->
            <div class="mt-4">
                <button type="submit" class="btn-mia-primary w-full py-3 text-base shadow-lg shadow-pink-200">
                    Entrar
                </button>
            </div>
        </form>

        <!-- Registro -->
        @if (Route::has('register'))
            <div class="mt-6 text-sm text-center text-gray-500">
                <span>¿No tienes una cuenta?</span>
                <a href="{{ route('register') }}" class="font-semibold text-[#FF5A79] hover:text-[#E64565] transition" wire:navigate>
                    Regístrate
                </a>
            </div>
        @endif
    </div>
</x-layouts.auth>
