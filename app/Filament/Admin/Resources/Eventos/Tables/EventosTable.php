<?php

namespace App\Filament\Admin\Resources\Eventos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('hora')
                    ->time()
                    ->sortable(),
                TextColumn::make('lugar')
                    ->searchable(),
                TextColumn::make('tipo_evento')
                    ->searchable(),
                TextColumn::make('invitados')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('costo')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cliente_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
