<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Reserva;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservasStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalReservas = Reserva::count();
        $reservasMesActual = Reserva::whereMonth('fecha_reserva', now()->month)->count();
        $reservasMesAnterior = Reserva::whereMonth('fecha_reserva', now()->subMonth()->month)->count();
        
        $porcentajeReservas = $reservasMesAnterior > 0 
            ? (($reservasMesActual - $reservasMesAnterior) / $reservasMesAnterior) * 100 
            : 0;

        $totalEventos = Evento::count();
        $eventosMesActual = Evento::whereMonth('fecha', now()->month)->count();
        $eventosMesAnterior = Evento::whereMonth('fecha', now()->subMonth()->month)->count();
        
        $porcentajeEventos = $eventosMesAnterior > 0 
            ? (($eventosMesActual - $eventosMesAnterior) / $eventosMesAnterior) * 100 
            : 0;

        $totalClientes = Cliente::count();
        $clientesMesActual = Cliente::whereMonth('created_at', now()->month)->count();

        $ingresoTotal = Reserva::where('estado', 'confirmada')->sum('total');
        $ingresoMesActual = Reserva::where('estado', 'confirmada')
            ->whereMonth('fecha_reserva', now()->month)
            ->sum('total');

        return [
            Stat::make('Total Reservas', $totalReservas)
                ->description($porcentajeReservas > 0 ? '+' . number_format($porcentajeReservas, 1) . '% vs mes anterior' : number_format($porcentajeReservas, 1) . '% vs mes anterior')
                ->descriptionIcon($porcentajeReservas > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($porcentajeReservas > 0 ? 'success' : 'danger')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Eventos Este Mes', $eventosMesActual)
                ->description('Total: ' . $totalEventos . ' eventos')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->chart([3, 5, 2, 8, 4, 6, 7, 4]),

            Stat::make('Ingresos Este Mes', '$' . number_format($ingresoMesActual, 2))
                ->description('Total acumulado: $' . number_format($ingresoTotal, 2))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([5, 10, 7, 15, 9, 12, 8, 14]),

            Stat::make('Clientes Activos', $totalClientes)
                ->description('+' . $clientesMesActual . ' este mes')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning')
                ->chart([2, 3, 1, 4, 2, 3, 2, 5]),
        ];
    }
}