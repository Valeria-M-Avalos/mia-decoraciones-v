<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Widgets\EventosChart;
use App\Filament\Admin\Widgets\EventosPorTipoChart;
use App\Filament\Admin\Widgets\IngresosChart;
use App\Filament\Admin\Widgets\ReservasStats;
use App\Filament\Admin\Widgets\ServiciosPopularesChart; // ¡Añadimos este nuevo Chart!
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
            ->brandName('Mía Decoraciones')
            ->brandLogo(asset('images/logo.png'))
            ->darkModeBrandLogo(asset('images/logo.png'))
            ->favicon(asset('images/favicon.svg'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => [
                    50 => '#fef2f4',
                    100 => '#fde6e9',
                    200 => '#fbd0d9',
                    300 => '#f8aabb',
                    400 => '#f47694',
                    500 => '#FF5A79', // Rosa principal del logo
                    600 => '#e63559',
                    700 => '#c2274a',
                    800 => '#a22344',
                    900 => '#8a2140',
                    950 => '#4d0d20',
                ],
            ])
            ->font('Inter')
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\Filament\Admin\Widgets')
            ->widgets([
                // 1. STATS: Ocupan la fila superior y se auto-dividen
                ReservasStats::class,           
                
                // 2. FILA DE GRÁFICOS (SUMA 12 COLUMNAS)
                EventosChart::class,            // Dándole 6 columnas
                IngresosChart::class,           // Dándole 6 columnas
                
                // 3. FILA DE GRÁFICOS RESTANTES (Ajustamos para 4 + 4 + 4, o dejamos 12/full width)
                EventosPorTipoChart::class,     // Dándole 4 columnas (si quieres 3 en una fila)
                ServiciosPopularesChart::class, // Dándole 4 columnas (si quieres 3 en una fila)
                
                // Widgets de sistema
                AccountWidget::class,
            ])
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}