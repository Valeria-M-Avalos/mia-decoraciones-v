<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Reserva;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class IngresosMensualesChart extends ChartWidget
{
    protected static ?int $sort = 6;
    
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $meses = [];
        $ingresos = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $fecha = now()->subMonths($i);
            $meses[] = $fecha->format('M Y');
            
            $ingreso = Reserva::where('estado', 'confirmada')
                ->whereYear('fecha_reserva', $fecha->year)
                ->whereMonth('fecha_reserva', $fecha->month)
                ->sum('total');
            
            $ingresos[] = $ingreso;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos ($)',
                    'data' => $ingresos,
                    'backgroundColor' => 'rgba(255, 90, 121, 0.8)',
                    'borderColor' => 'rgb(255, 90, 121)',
                ],
            ],
            'labels' => $meses,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
    public function getHeading(): ?string
    {
        return 'Ingresos Últimos 6 Meses';
    }
}