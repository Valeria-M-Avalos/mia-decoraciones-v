<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Evento;
use Filament\Widgets\ChartWidget;

class ServiciosPopularesChart extends ChartWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $servicios = Evento::select('tipo_evento')
            ->selectRaw('count(*) as total')
            ->groupBy('tipo_evento')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Eventos por tipo',
                    'data' => $servicios->pluck('total'),
                    'backgroundColor' => [
                        'rgba(255, 90, 121, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                    ],
                ],
            ],
            'labels' => $servicios->pluck('tipo_evento'),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    public function getHeading(): ?string
    {
        return 'Tipos de Eventos Más Solicitados';
    }
}
