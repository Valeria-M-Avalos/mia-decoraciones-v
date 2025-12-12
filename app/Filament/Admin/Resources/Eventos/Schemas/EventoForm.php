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

                TextInput::make('titulo')->required(),

                Textarea::make('descripcion')->columnSpanFull(),

                DatePicker::make('fecha')->required(),

                TimePicker::make('hora')->required(),

                TextInput::make('lugar'),

                Select::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos'        => 'Cumpleaños',
                        '15'                => 'Fiesta de 15 Años',
                        'casamiento'        => 'Casamiento',
                        'bautismo'          => 'Bautismo',
                        'baby_shower'       => 'Baby Shower',
                        'aniversario'       => 'Aniversario',
                        'reunion_familiar'  => 'Reunión Familiar',
                        'corporativo'       => 'Evento Corporativo',
                        'otros'             => 'Otros eventos'
                    ])
                    ->searchable()
                    ->required(),

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

                TextInput::make('costo')
                    ->label('Costo total (calculado)')
                    ->disabled(),

                Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        \App\Models\Cliente::query()
                            ->orderBy('nombre')
                            ->get()
                            ->mapWithKeys(fn ($cliente) => [
                                $cliente->id =>
                                    $cliente->nombre . ' ' .
                                    $cliente->apellido . ' — ' . $cliente->telefono
                            ])
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('estado')
                    ->required()
                    ->default('Pendiente'),

                // ----------------------------
                // 🔥 REPEATER DE SERVICIOS
                // ----------------------------
                Repeater::make('servicios')
                    ->relationship('servicios')
                    ->schema([

                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->options(\App\Models\Servicio::pluck('nombre', 'id'))
                            ->searchable()
                            ->reactive()
                            ->required(),

                        TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->default(1)
                            ->inputMode('numeric')
                            ->extraInputAttributes(['pattern' => '[0-9]*'])
                            ->reactive()
                            ->visible(fn ($get) => intval($get('servicio_id')) !== 7)
                            ->required(fn ($get) => intval($get('servicio_id')) !== 7),

                        TextInput::make('precio')
                            ->label('Precio del servicio')
                            ->inputMode('numeric')
                            ->extraInputAttributes(['pattern' => '[0-9]*'])
                            ->reactive()
                            ->visible(fn ($get) => intval($get('servicio_id')) !== 7)
                            ->required(fn ($get) => intval($get('servicio_id')) !== 7),

                        Textarea::make('descripcion_personalizada')
                            ->label('Descripción personalizada')
                            ->placeholder('Ingrese los detalles solicitados...')
                            ->columnSpanFull()
                            ->reactive()
                            ->visible(fn ($get) => intval($get('servicio_id')) === 7)
                            ->required(fn ($get) => intval($get('servicio_id')) === 7),

                        TextInput::make('precio_personalizado')
                            ->label('Precio personalizado')
                            ->inputMode('numeric')
                            ->extraInputAttributes(['pattern' => '[0-9]*'])
                            ->reactive()
                            ->visible(fn ($get) => intval($get('servicio_id')) === 7)
                            ->required(fn ($get) => intval($get('servicio_id')) === 7),

                    ])
                    ->columns(3)
                    ->label('Servicios del Evento')
                    ->minItems(1),
            ]);
    }
}
