<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Widgets\EventosChart;
use App\Filament\Admin\Widgets\IngresosMensualesChart;
use App\Filament\Admin\Widgets\ReservasStats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            // Branding
            ->brandName('Mía Decoraciones')
            ->brandLogo(asset('images/logo.png'))
            ->darkModeBrandLogo(asset('images/logo.png'))
            ->favicon(asset('images/favicon.svg'))

            // Tema
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => [
                    50 => '#fef2f4',
                    100 => '#fde6e9',
                    200 => '#fbd0d9',
                    300 => '#f8aabb',
                    400 => '#f47694',
                    500 => '#FF5A79',
                    600 => '#e63559',
                    700 => '#c2274a',
                    800 => '#a22344',
                    900 => '#8a2140',
                    950 => '#4d0d20',
                ],
            ])
            ->font('Inter')

            // Recursos y páginas
            ->discoverResources(
                in: app_path('Filament/Admin/Resources'),
                for: 'App\\Filament\\Admin\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Admin/Pages'),
                for: 'App\\Filament\\Admin\\Pages'
            )
            ->pages([
                Dashboard::class,
            ])

            // Notificaciones
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')

            // Widgets
            ->discoverWidgets(
                in: app_path('Filament/Admin/Widgets'),
                for: 'App\\Filament\\Admin\\Widgets'
            )
            ->widgets([
                // Estadísticas superiores
                ReservasStats::class,

                // Gráficos
                EventosChart::class,
                IngresosMensualesChart::class,

                // Widget de cuenta
                AccountWidget::class,
            ])

            // Middleware
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            // Auth
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
