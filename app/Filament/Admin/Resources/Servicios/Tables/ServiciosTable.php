<?php

namespace App\Filament\Admin\Resources\Servicios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ServiciosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('precio')
                    ->money('ARS')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Eliminar seleccionados')

                        // 👁️ Controla si se muestra
                        ->visible(fn (Collection $records) =>
                            $records->every(
                                fn ($servicio) =>
                                    strtolower($servicio->nombre) !== 'personalizado'
                            )
                        )

                        // 🔐 Controla si se ejecuta
                        ->authorize(fn (Collection $records) =>
                            $records->every(
                                fn ($servicio) =>
                                    strtolower($servicio->nombre) !== 'personalizado'
                            )
                        ),
                ]),
            ]);
    }
}
