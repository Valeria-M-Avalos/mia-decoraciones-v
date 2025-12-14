<?php

namespace App\Filament\Admin\Resources\GaleriaImagens;

use App\Filament\Admin\Resources\GaleriaImagens\Pages\CreateGaleriaImagen;
use App\Filament\Admin\Resources\GaleriaImagens\Pages\EditGaleriaImagen;
use App\Filament\Admin\Resources\GaleriaImagens\Pages\ListGaleriaImagens;
use App\Filament\Admin\Resources\GaleriaImagens\Schemas\GaleriaImagenForm;
use App\Filament\Admin\Resources\GaleriaImagens\Tables\GaleriaImagensTable;
use App\Models\GaleriaImagen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GaleriaImagenResource extends Resource
{
    protected static ?string $model = GaleriaImagen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'titulo';
    
    protected static ?string $navigationLabel = 'Galería';
    
    protected static ?string $modelLabel = 'Imagen';
    
    protected static ?string $pluralModelLabel = 'Galería de Imágenes';

    public static function form(Schema $schema): Schema
    {
        return GaleriaImagenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GaleriaImagensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGaleriaImagens::route('/'),
            'create' => CreateGaleriaImagen::route('/create'),
            'edit' => EditGaleriaImagen::route('/{record}/edit'),
        ];
    }
}