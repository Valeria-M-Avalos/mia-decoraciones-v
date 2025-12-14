<?php

namespace App\Filament\Admin\Resources\Eventos\Schemas;

use App\Enums\TipoEvento;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class EventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('titulo')
                    ->required(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),

                DatePicker::make('fecha')->required(),
                TimePicker::make('hora')->required(),

                TextInput::make('lugar'),

                Select::make('tipo_evento')
    ->label('Tipo de evento')
    ->options(TipoEvento::options())
    ->required(),


                // ✅ ESTADO DEBAJO DE TIPO (como pediste)
                Select::make('estado')
                    ->label('Estado del evento')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Confirmado' => 'Confirmado',
                        'Cancelado' => 'Cancelado',
                    ])
                    ->default('Pendiente')
                    ->required(),

                TextInput::make('invitados')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $set('costo',
                            ($get('costo_base') ?? 0) +
                            ((float) $state * ($get('costo_por_invitado') ?? 0))
                        );
                    }),

                TextInput::make('costo_base')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $set('costo',
                            (float) $state +
                            (($get('invitados') ?? 0) * ($get('costo_por_invitado') ?? 0))
                        );
                    }),

                TextInput::make('costo_por_invitado')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $set('costo',
                            ($get('costo_base') ?? 0) +
                            (($get('invitados') ?? 0) * (float) $state)
                        );
                    }),

                TextInput::make('costo')
                    ->label('Costo del evento')
                    ->disabled()
                    ->numeric(),

                Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        \App\Models\Cliente::orderBy('nombre')->get()
                            ->mapWithKeys(fn ($c) => [
                                $c->id => "{$c->nombre} {$c->apellido} — {$c->telefono}"
                            ])
                    )
                    ->searchable()
                    ->required(),

                // -------------------------
                // ✅ REPEATER (sigue igual)
                // -------------------------
                Repeater::make('servicios')
                    ->label('Servicios del evento')
                    ->schema([
                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->options(\App\Models\Servicio::pluck('nombre', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('cantidad')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('precio')
                            ->label('Precio del servicio')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(3)
                    ->minItems(1)
                    ->columnSpanFull(),

                // ✅ Total servicios (VISUAL)
                Placeholder::make('total_servicios')
                    ->label('Total de servicios')
                    ->content(function (Get $get) {
                        $total = 0;

                        foreach (($get('servicios') ?? []) as $item) {
                            $total += ((float) ($item['cantidad'] ?? 1)) * ((float) ($item['precio'] ?? 0));
                        }

                        return '$' . number_format($total, 0, ',', '.');
                    }),

                // ✅ Total general (evento + servicios) (VISUAL)
                // (queda del lado derecho por columns(2), cerca de los costos)
                Placeholder::make('total_general')
                    ->label('Total general del evento')
                    ->content(function (Get $get) {
                        $totalServicios = 0;

                        foreach (($get('servicios') ?? []) as $item) {
                            $totalServicios += ((float) ($item['cantidad'] ?? 1)) * ((float) ($item['precio'] ?? 0));
                        }

                        $costoEvento = (float) ($get('costo') ?? 0);

                        return '$' . number_format($costoEvento + $totalServicios, 0, ',', '.');
                    }),
            ]);
    }
}
