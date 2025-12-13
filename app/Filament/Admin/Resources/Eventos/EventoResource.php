<?php

namespace App\Filament\Admin\Resources\Eventos;

use App\Filament\Admin\Resources\Eventos\Pages\CreateEvento;
use App\Filament\Admin\Resources\Eventos\Pages\EditEvento;
use App\Filament\Admin\Resources\Eventos\Pages\ListEventos;
use App\Filament\Admin\Resources\Eventos\Schemas\EventoForm;
use App\Filament\Admin\Resources\Eventos\Tables\EventosTable;
use App\Models\Evento;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return EventoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventosTable::configure($table);
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
            'index' => ListEventos::route('/'),
            'create' => CreateEvento::route('/create'),
            'edit' => EditEvento::route('/{record}/edit'),
        ];
    }
}
