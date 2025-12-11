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

                // --------------------------------
                // TITULO / DESCRIPCIÓN
                // --------------------------------
                TextInput::make('titulo')
                    ->required(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),

                // --------------------------------
                // FECHA / HORA
                // --------------------------------
                DatePicker::make('fecha')
                    ->required(),

                TimePicker::make('hora')
                    ->required(),

                // --------------------------------
                // LUGAR
                // --------------------------------
                TextInput::make('lugar'),

                // --------------------------------
                // TIPO DE EVENTO
                // --------------------------------
                Select::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos' => 'Cumpleaños',
                        'casamiento' => 'Casamiento',
                        '15' => 'Fiesta de 15 Años',
                        'otros' => 'Otros',
                    ])
                    ->required(),

                // --------------------------------
                // INVITADOS
                // --------------------------------
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

                // --------------------------------
                // COSTO BASE
                // --------------------------------
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

                // --------------------------------
                // COSTO POR INVITADO
                // --------------------------------
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

                // --------------------------------
                // COSTO TOTAL (CALCULADO)
                // --------------------------------
                TextInput::make('costo')
                    ->label('Costo total (calculado)')
                    ->disabled(),

                // --------------------------------
                // SELECTOR DE CLIENTE
                // --------------------------------
                Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        \App\Models\Cliente::query()
                            ->orderBy('nombre')
                            ->get()
                            ->mapWithKeys(function ($cliente) {
                                return [
                                    $cliente->id =>
                                        $cliente->nombre . ' ' .
                                        $cliente->apellido . ' — ' .
                                        $cliente->telefono
                                ];
                            })
                    )
                    ->searchable()
                    ->required(),

                // --------------------------------
                // ESTADO
                // --------------------------------
                TextInput::make('estado')
                    ->required()
                    ->default('Pendiente'),

                // --------------------------------
                // SERVICIOS DEL EVENTO
                // --------------------------------
Repeater::make('servicios')
    ->relationship('servicios')
    ->schema([

        // ------------------------
        // SELECT SERVICIO
        // ------------------------
        Select::make('servicio_id')
            ->label('Servicio')
            ->options(\App\Models\Servicio::pluck('nombre', 'id'))
            ->searchable()
            ->reactive()
            ->required(),

        // ------------------------
        // CANTIDAD (solo si NO es personalizado)
        // ------------------------
        TextInput::make('cantidad')
            ->label('Cantidad')
            ->default(1)
            ->inputMode('numeric')
            ->extraInputAttributes(['pattern' => '[0-9]*'])
            ->reactive()
            ->visible(fn ($get) =>
                intval($get('servicio_id')) !== 7
            ),

        // ------------------------
        // PRECIO NORMAL (solo si NO es personalizado)
        // ------------------------
        TextInput::make('precio')
            ->label('Precio del servicio')
            ->inputMode('numeric')
            ->extraInputAttributes(['pattern' => '[0-9]*'])
            ->reactive()
            ->visible(fn ($get) =>
                intval($get('servicio_id')) !== 7
            ),

        // ------------------------
        // DESCRIPCIÓN PERSONALIZADA (solo si elige personalizado)
        // ------------------------
        Textarea::make('descripcion_personalizada')
            ->label('Descripción personalizada')
            ->placeholder('Ingrese los detalles del servicio solicitado por el cliente...')
            ->columnSpanFull()
            ->reactive()
            ->visible(fn ($get) =>
                intval($get('servicio_id')) === 7
            ),

        // ------------------------
        // PRECIO PERSONALIZADO (solo si es personalizado)
        // ------------------------
        TextInput::make('precio_personalizado')
            ->label('Precio personalizado')
            ->placeholder('Ingrese el precio acordado con el cliente')
            ->inputMode('numeric')
            ->extraInputAttributes(['pattern' => '[0-9]*'])
            ->reactive()
            ->visible(fn ($get) =>
                intval($get('servicio_id')) === 7
            ),

    ])
    ->columns(3)
    ->label('Servicios del Evento'),


            ]);
    }
}
