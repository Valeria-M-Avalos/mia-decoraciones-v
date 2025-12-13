<?php

use App\Http\Controllers\PublicController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// Tus componentes Livewire actuales
use App\Livewire\Clientes;
use App\Livewire\Servicios;
use App\Livewire\Eventos;
use App\Livewire\Reservas;
use App\Http\Livewire\Dashboard;

/* RUTAS PÚBLICAS (Sin autenticación)| Estas son las rutas de la página web pública*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/servicios-publicos', [PublicController::class, 'servicios'])->name('servicios.publicos');
Route::get('/eventos/{tipo}', [PublicController::class, 'eventoDetalle'])->name('eventos.detalle');
Route::get('/contacto', [PublicController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [PublicController::class, 'enviarContacto'])->name('contacto.send');

/* RUTAS PRIVADAS (Con autenticación) Dashboard y sistema de gestión interno*/

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    
    // CONFIGURACIONES DE USUARIO
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // MÓDULOS DE GESTIÓN (Sistema interno)
    Route::get('/clientes', Clientes::class)->name('clientes.index');
    Route::get('/servicios', Servicios::class)->name('servicios.index');
    Route::get('/eventos', Eventos::class)->name('eventos.index');
    Route::get('/reservas', Reservas::class)->name('reservas.index');

});