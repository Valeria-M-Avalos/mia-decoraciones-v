<?php

namespace App\Filament\Admin\Resources\Eventos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class EventosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->formatStateUsing(fn ($record) =>
                        $record->cliente
                            ? $record->cliente->nombre . ' ' . $record->cliente->apellido
                            : 'Sin cliente'
                    )
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tipo_evento')
                    ->label('Tipo de Evento')
                    ->badge()
                    ->colors([
                        'primary'   => 'cumpleanos',
                        'warning'   => '15',
                        'success'   => 'casamiento',
                        'info'      => 'bautismo',
                        'danger'    => 'corporativo',
                        'gray'      => 'otros',
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('costo')
                    ->label('Costo Total')
                    ->money('ARS', true)
                    ->sortable(),

                TextColumn::make('servicios_count')
                    ->label('Servicios')
                    ->counts('servicios')
                    ->sortable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->colors([
                        'warning'   => 'Pendiente',
                        'success'   => 'Confirmada',
                        'danger'    => 'Cancelada',
                    ])
                    ->sortable(),
            ])

            ->filters([
                // FILTRO POR TIPO DE EVENTO
                SelectFilter::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos'        => 'Cumpleaños',
                        '15'                => 'Fiesta de 15 Años',
                        'casamiento'        => 'Casamiento',
                        'bautismo'          => 'Bautismo',
                        'baby_shower'       => 'Baby Shower',
                        'aniversario'       => 'Aniversario',
                        'reunion_familiar'  => 'Reunión Familiar',
                        'corporativo'       => 'Corporativo',
                        'otros'             => 'Otros eventos',
                    ]),

                // FILTRO POR ESTADO
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'Pendiente'   => 'Pendiente',
                        'Confirmada'  => 'Confirmada',
                        'Cancelada'   => 'Cancelada',
                    ]),

                // FILTRO POR RANGO DE FECHAS
                Filter::make('fecha')
                    ->form([
                        DatePicker::make('desde')->label('Desde'),
                        DatePicker::make('hasta')->label('Hasta'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['desde'] ?? null, fn ($q) =>
                                $q->where('fecha', '>=', $data['desde'])
                            )
                            ->when($data['hasta'] ?? null, fn ($q) =>
                                $q->where('fecha', '<=', $data['hasta'])
                            );
                    }),

                // FILTRO POR CLIENTE
                SelectFilter::make('cliente_id')
                    ->label('Cliente')
                    ->relationship('cliente', 'nombre'),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
