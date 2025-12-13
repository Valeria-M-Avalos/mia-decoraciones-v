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

                // ============================
                // DATOS GENERALES
                // ============================
                TextInput::make('titulo')
                    ->label('Título del evento')
                    ->required(),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->columnSpanFull(),

                DatePicker::make('fecha')
                    ->required(),

                TimePicker::make('hora')
                    ->required(),

                TextInput::make('lugar'),

                // ============================
                // TIPO DE EVENTO
                // ============================
                Select::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos' => 'Cumpleaños',
                        '15' => 'Fiesta de 15 Años',
                        'casamiento' => 'Casamiento',
                        'bautismo' => 'Bautismo',
                        'baby_shower' => 'Baby Shower',
                        'aniversario' => 'Aniversario',
                        'reunion_familiar' => 'Reunión Familiar',
                        'corporativo' => 'Evento Corporativo',
                        'otros' => 'Otros',
                    ])
                    ->searchable()
                    ->required(),

                // ============================
                // COSTOS
                // ============================
                TextInput::make('invitados')
                    ->label('Cantidad de invitados')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set, $get) =>
                        $set('costo',
                            ($get('costo_base') ?? 0) +
                            ($state * ($get('costo_por_invitado') ?? 0))
                        )
                    ),

                TextInput::make('costo_base')
                    ->label('Costo base')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set, $get) =>
                        $set('costo',
                            $state +
                            (($get('invitados') ?? 0) * ($get('costo_por_invitado') ?? 0))
                        )
                    ),

                TextInput::make('costo_por_invitado')
                    ->label('Costo por invitado')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set, $get) =>
                        $set('costo',
                            ($get('costo_base') ?? 0) +
                            (($get('invitados') ?? 0) * $state)
                        )
                    ),

                TextInput::make('costo')
                    ->label('Costo total')
                    ->disabled(),

                // ============================
                // CLIENTE
                // ============================
                Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(
                        \App\Models\Cliente::query()
                            ->orderBy('nombre')
                            ->get()
                            ->mapWithKeys(fn ($c) => [
                                $c->id => "{$c->nombre} {$c->apellido} — {$c->telefono}"
                            ])
                    )
                    ->searchable()
                    ->required(),

                // ============================
                // ESTADO
                // ============================
                Select::make('estado')
                    ->label('Estado del evento')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Confirmado' => 'Confirmado',
                        'Cancelado' => 'Cancelado',
                    ])
                    ->default('Pendiente')
                    ->required(),

                // ============================
                // SERVICIOS
                // ============================
                Repeater::make('servicios')
            
                    ->schema([

                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->options(\App\Models\Servicio::pluck('nombre', 'id'))
                            ->searchable()
                            ->reactive()
                            ->required(),

                        TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->visible(fn ($get) => $get('servicio_id') != 7)
                            ->required(fn ($get) => $get('servicio_id') != 7),

                        TextInput::make('precio')
                            ->label('Precio')
                            ->numeric()
                            ->visible(fn ($get) => $get('servicio_id') != 7)
                            ->required(fn ($get) => $get('servicio_id') != 7),

                        Textarea::make('descripcion_personalizada')
                            ->label('Descripción personalizada')
                            ->placeholder('Detalle solicitado por el cliente')
                            ->columnSpanFull()
                            ->visible(fn ($get) => $get('servicio_id') == 7)
                            ->required(fn ($get) => $get('servicio_id') == 7),
                    ])
                    ->minItems(1)
                    ->columns(3)
                    ->label('Servicios del evento'),
            ]);
    }
}
