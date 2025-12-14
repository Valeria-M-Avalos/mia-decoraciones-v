<x-layouts.auth>
    <div class="mia-card p-8 w-full max-w-[420px] mx-auto">
        
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Crear Cuenta</h2>
            <p class="text-sm text-gray-500 mt-2">Únete a Mía Decoraciones</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                <input type="text" name="name" id="name" class="mia-input" placeholder="Tu nombre" value="{{ old('name') }}" required autofocus>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="mia-input" placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" id="password" class="mia-input" placeholder="••••••••" required>
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mia-input" placeholder="••••••••" required>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn-mia-primary w-full py-3 text-base shadow-lg shadow-pink-200">
                    Registrarse
                </button>
            </div>

            <div class="mt-4 text-center text-sm text-gray-500">
                <span>¿Ya tienes una cuenta?</span>
                <a href="{{ route('login') }}" class="font-semibold text-[#FF5A79] hover:text-[#E64565] transition" wire:navigate>
                    Inicia Sesión
                </a>
            </div>
        </form>
    </div>
</x-layouts.auth>