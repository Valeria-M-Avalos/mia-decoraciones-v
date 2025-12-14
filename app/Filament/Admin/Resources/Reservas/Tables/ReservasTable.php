<?php

namespace App\Filament\Admin\Resources\Reservas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;

class ReservasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha_reserva')
                    ->label('Fecha de Reserva')
                    ->date()
                    ->sortable(),

                TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable(),

                TextColumn::make('evento.titulo')
                    ->label('Evento')
                    ->searchable(),

                TextColumn::make('senia')
                    ->label('Seña')
                    ->money('ARS'),

                TextColumn::make('total')
                    ->label('Total')
                    ->money('ARS'),

                TextColumn::make('estado')
                    ->badge()
                    ->colors([
                        'warning' => 'pendiente',
                        'info'    => 'senado',
                        'success' => 'confirmada',
                        'danger'  => 'cancelada',
                    ])
                    ->sortable(),
            ])

            // =========================
            // FILTROS
            // =========================
            ->filters([

                // FILTRO POR ESTADO
                SelectFilter::make('estado')
                    ->label('Estado de la reserva')
                    ->options([
                        'pendiente'  => 'Pendiente',
                        'senado'     => 'Señado',
                        'confirmada' => 'Confirmada',
                        'cancelada'  => 'Cancelada',
                    ]),

                // FILTRO POR RANGO DE FECHAS
                Filter::make('fecha_reserva')
                    ->form([
                        DatePicker::make('desde')->label('Desde'),
                        DatePicker::make('hasta')->label('Hasta'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['desde'],
                                fn ($q) => $q->whereDate('fecha_reserva', '>=', $data['desde'])
                            )
                            ->when(
                                $data['hasta'],
                                fn ($q) => $q->whereDate('fecha_reserva', '<=', $data['hasta'])
                            );
                    }),
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
