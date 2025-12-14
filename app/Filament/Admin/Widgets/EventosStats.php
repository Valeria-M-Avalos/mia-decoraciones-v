<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Evento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventosStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de eventos', Evento::count())
                ->description('Eventos registrados')
                ->color('primary'),

            Stat::make('Eventos confirmados', Evento::where('estado', 'Confirmado')->count())
                ->description('Eventos activos')
                ->color('success'),

            Stat::make('Eventos pendientes', Evento::where('estado', 'Pendiente')->count())
                ->description('Por confirmar')
                ->color('warning'),

            Stat::make('Ingresos estimados', '$ ' . number_format(Evento::sum('costo'), 0, ',', '.'))
                ->description('Suma total de eventos')
                ->color('info'),
        ];
    }
}
