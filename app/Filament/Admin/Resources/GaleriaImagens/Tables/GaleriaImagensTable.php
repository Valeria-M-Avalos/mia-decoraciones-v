<?php

namespace App\Filament\Admin\Resources\GaleriaImagens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class GaleriaImagensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public')
                    ->size(80)
                    ->square(),
                
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('tipo_evento')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cumpleaños' => '🎂 Cumpleaños',
                        'boda' => '💍 Boda',
                        'xv_años' => '✨ XV Años',
                        'bautizo' => '🎁 Bautizo',
                        default => $state,
                    }),
                
                TextColumn::make('categoria')
                    ->label('Carpeta')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cumpleanos' => '📁 Cumpleaños',
                        'bodas' => '📁 Bodas',
                        'xv_anos' => '📁 XV Años',
                        'bautizos' => '📁 Bautizos',
                        'decoracion' => '📁 Decoración',
                        'otros' => '📁 Otros',
                        'general' => '📁 General',
                        default => '📁 ' . ucfirst($state),
                    }),
                
                IconColumn::make('destacada')
                    ->label('★')
                    ->boolean(),
                
                TextColumn::make('orden')
                    ->label('#')
                    ->sortable(),
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
            ])
            ->defaultSort('orden', 'asc');
    }
}