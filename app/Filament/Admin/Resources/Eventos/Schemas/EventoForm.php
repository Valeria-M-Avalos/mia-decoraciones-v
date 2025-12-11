<?php

namespace App\Filament\Admin\Resources\Eventos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('titulo')
                    ->required(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),

                DatePicker::make('fecha')
                    ->required(),

                TimePicker::make('hora')
                    ->required(),

                TextInput::make('lugar'),

                Select::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos' => 'Cumpleaños',
                        'casamiento' => 'Casamiento',
                        '15' => 'Fiesta de 15 Años',
                        'otros' => 'Otros',
                    ])
                    ->required(),

                // -----------------------------
                // INVITADOS
                // -----------------------------
                TextInput::make('invitados')
                    ->label('Invitados')
                    ->required()
                    ->inputMode('numeric')
                    ->extraInputAttributes(['pattern' => '[0-9]*'])
                    ->debounce(500)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $invitados = intval($state);
                        $precioInv = intval($get('costo_por_invitado') ?? 0);
                        $base = intval($get('costo_base') ?? 0);
                        $set('costo', $base + ($invitados * $precioInv));
                    }),

                // -----------------------------
                // COSTO BASE
                // -----------------------------
                TextInput::make('costo_base')
                    ->label('Costo base')
                    ->required()
                    ->inputMode('numeric')
                    ->extraInputAttributes(['pattern' => '[0-9]*'])
                    ->debounce(500)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $base = intval($state);
                        $invitados = intval($get('invitados') ?? 0);
                        $precioInv = intval($get('costo_por_invitado') ?? 0);
                        $set('costo', $base + ($invitados * $precioInv));
                    }),

                // -----------------------------
                // COSTO POR INVITADO
                // -----------------------------
                TextInput::make('costo_por_invitado')
                    ->label('Costo por invitado')
                    ->required()
                    ->inputMode('numeric')
                    ->extraInputAttributes(['pattern' => '[0-9]*'])
                    ->debounce(500)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $precioInv = intval($state);
                        $invitados = intval($get('invitados') ?? 0);
                        $base = intval($get('costo_base') ?? 0);
                        $set('costo', $base + ($invitados * $precioInv));
                    }),

                // -----------------------------
                // COSTO TOTAL (CALCULADO)
                // -----------------------------
                TextInput::make('costo')
                    ->label('Costo total (calculado)')
                    ->disabled(),

                TextInput::make('cliente_id')
                    ->required()
                    ->numeric(),

                TextInput::make('estado')
                    ->required()
                    ->default('Pendiente'),

                // -----------------------------
                // SERVICIOS DEL EVENTO
                // -----------------------------
                Repeater::make('servicios')
                    ->relationship('servicios')
                    ->schema([

                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->options(\App\Models\Servicio::pluck('nombre', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->default(1)
                            ->inputMode('numeric')
                            ->extraInputAttributes(['pattern' => '[0-9]*'])
                            ->required(),

                        TextInput::make('precio')
                            ->label('Precio del servicio')
                            ->inputMode('numeric')
                            ->extraInputAttributes(['pattern' => '[0-9]*'])
                            ->required(),

                    ])
                    ->columns(3)
                    ->label('Servicios del Evento'),
            ]);
    }
}
