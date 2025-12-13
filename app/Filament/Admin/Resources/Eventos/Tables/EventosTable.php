<?php

namespace App\Filament\Admin\Resources\Eventos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;

class EventosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fecha')
                    ->date()
                    ->sortable(),

                TextColumn::make('hora')
                    ->time(),

                TextColumn::make('lugar')
                    ->searchable(),

                TextColumn::make('tipo_evento')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('estado')
                    ->badge()
                    ->colors([
                        'warning' => 'Pendiente',
                        'success' => 'Confirmado',
                        'danger'  => 'Cancelado',
                    ])
                    ->sortable(),

                TextColumn::make('invitados')
                    ->numeric()
                    ->sortable(),

                // ✅ COSTO SIN "PESOS"
                TextColumn::make('costo_general')
                    ->label('Costo')
                    ->sortable()
                    ->formatStateUsing(fn ($state) =>
                        '$' . number_format($state, 2, ',', '.')
                    ),
            ])

            // ========================
            // FILTROS
            // ========================
            ->filters([

                SelectFilter::make('tipo_evento')
                    ->label('Tipo de evento')
                    ->options([
                        'cumpleanos' => 'Cumpleaños',
                        '15' => '15 Años',
                        'casamiento' => 'Casamiento',
                        'bautismo' => 'Bautismo',
                        'baby_shower' => 'Baby Shower',
                        'aniversario' => 'Aniversario',
                        'reunion_familiar' => 'Reunión Familiar',
                        'corporativo' => 'Corporativo',
                        'otros' => 'Otros',
                    ]),

                SelectFilter::make('estado')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Confirmado' => 'Confirmado',
                        'Cancelado' => 'Cancelado',
                    ]),

                Filter::make('fecha')
                    ->form([
                        DatePicker::make('desde')->label('Desde'),
                        DatePicker::make('hasta')->label('Hasta'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['desde'],
                                fn ($q) => $q->whereDate('fecha', '>=', $data['desde']))
                            ->when($data['hasta'],
                                fn ($q) => $q->whereDate('fecha', '<=', $data['hasta']));
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
