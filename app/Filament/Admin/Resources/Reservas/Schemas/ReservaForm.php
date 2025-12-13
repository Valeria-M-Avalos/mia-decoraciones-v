<?php

namespace App\Filament\Admin\Resources\Reservas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReservaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                // FECHA
                DatePicker::make('fecha_reserva')
                    ->label('Fecha reserva')
                    ->required(),

                // CLIENTE
                Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        \App\Models\Cliente::all()
                            ->mapWithKeys(fn($c) => [
                                $c->id => "{$c->nombre} {$c->apellido} — {$c->telefono}"
                            ])
                    )
                    ->searchable()
                    ->required(),

                // EVENTO
                Select::make('evento_id')
                    ->label('Evento')
                    ->options(
                        \App\Models\Evento::all()
                            ->mapWithKeys(fn($e) => [
                                $e->id => "{$e->titulo} — {$e->fecha} — $" . number_format($e->costo, 0, ',', '.')
                            ])
                    )
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if (!$state) return;

                        $evento = \App\Models\Evento::find($state);
                        $senia = floatval($get('senia') ?? 0);

                        $set('total', max($evento->costo - $senia, 0));
                    }),

                // SEÑA
                TextInput::make('senia')
                    ->label('Seña')
                    ->numeric()
                    ->default(0)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $eventoId = $get('evento_id');

                        if (!$eventoId) return;

                        $evento = \App\Models\Evento::find($eventoId);
                        $senia = floatval($state ?? 0);

                        $set('total', max($evento->costo - $senia, 0));
                    }),

                // TOTAL (CALCULADO)
                TextInput::make('total')
                    ->label('Total a pagar')
                    ->disabled()
                    ->dehydrated(true) // Se guarda en la BD aunque esté deshabilitado
                    ->numeric(),

                // ESTADO
                Select::make('estado')
                    ->label('Estado de reserva')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'senado' => 'Señado',
                        'confirmada' => 'Confirmada',
                        'cancelada' => 'Cancelada',
                    ])
                    ->default('pendiente')
                    ->required(),

                // MÉTODO DE PAGO
                TextInput::make('metodo_pago')
                    ->label('Método de pago')
                    ->placeholder('Efectivo, transferencia...'),

                // OBSERVACIONES
                Textarea::make('observaciones')
                    ->label('Observaciones')
                    ->columnSpanFull(),
            ]);
    }
}
