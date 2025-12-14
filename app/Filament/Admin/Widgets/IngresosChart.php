<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Reserva;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class IngresosChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $ingresos = Reserva::select(
            DB::raw('DATE_FORMAT(fecha_reserva, "%Y-%m") as mes'),
            DB::raw('SUM(total) as total')
        )
        ->where('estado', 'confirmada')
        ->where('fecha_reserva', '>=', now()->subMonths(6))
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos ($)',
                    'data' => $ingresos->pluck('total'),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
            ],
            'labels' => $ingresos->pluck('mes'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getHeading(): ?string
    {
        return 'Ingresos por Mes';
    }
}
