<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Solicitud;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservasStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // CLIENTES
        $totalClientes = Cliente::count();
        $clientesMesActual = Cliente::whereMonth('created_at', now()->month)->count();
        $clientesMesAnterior = Cliente::whereMonth('created_at', now()->subMonth()->month)->count();
        $porcentajeClientes = $clientesMesAnterior > 0 
            ? (($clientesMesActual - $clientesMesAnterior) / $clientesMesAnterior) * 100 
            : 0;

        // SOLICITUDES PENDIENTES
        $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->count();

        // EVENTOS
        $totalEventos = Evento::count();
        $eventosMesActual = Evento::whereMonth('fecha', now()->month)->count();
        
        // RESERVAS
        $totalReservas = Reserva::count();
        $reservasConfirmadas = Reserva::where('estado', 'confirmada')->count();
        
        // INGRESOS
        $ingresoTotal = Reserva::where('estado', 'confirmada')->sum('total');
        $ingresoMesActual = Reserva::where('estado', 'confirmada')
            ->whereMonth('fecha_reserva', now()->month)
            ->sum('total');

        return [
            Stat::make('Solicitudes Pendientes', $solicitudesPendientes)
                ->description('Nuevas consultas por atender')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning')
                ->chart([3, 5, 7, 4, 8, 6, 5])
                ->url(route('filament.admin.resources.solicituds.index')),

            Stat::make('Total Clientes', $totalClientes)
                ->description($porcentajeClientes > 0 ? '+' . number_format($porcentajeClientes, 1) . '% vs mes anterior' : number_format($porcentajeClientes, 1) . '% vs mes anterior')
                ->descriptionIcon($porcentajeClientes > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($porcentajeClientes > 0 ? 'success' : 'danger')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('Eventos Este Mes', $eventosMesActual)
                ->description('Total: ' . $totalEventos . ' eventos')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->chart([3, 5, 2, 8, 4, 6, 7, 4]),

            Stat::make('Ingresos Este Mes', '$' . number_format($ingresoMesActual, 0, ',', '.'))
                ->description('Total: $' . number_format($ingresoTotal, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([5, 10, 7, 15, 9, 12, 8, 14]),
        ];
    }
}