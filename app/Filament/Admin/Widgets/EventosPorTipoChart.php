<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Evento;
use Filament\Widgets\ChartWidget;

class EventosPorTipoChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $eventos = Evento::select('tipo_evento')
            ->selectRaw('count(*) as total')
            ->groupBy('tipo_evento')
            ->get();

        $colores = [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de eventos',
                    'data' => $eventos->pluck('total'),
                    'backgroundColor' => array_slice($colores, 0, $eventos->count()),
                ],
            ],
            'labels' => $eventos->pluck('tipo_evento'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public function getHeading(): ?string
    {
        return 'Eventos por Tipo';
    }
}
