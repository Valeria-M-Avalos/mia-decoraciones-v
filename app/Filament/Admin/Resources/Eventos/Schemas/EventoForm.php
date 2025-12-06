<?php

namespace App\Filament\Admin\Resources\Eventos\Schemas;

use Filament\Forms\Components\DatePicker;
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
                TextInput::make('titulo')
                    ->required(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                DatePicker::make('fecha')
                    ->required(),
                TimePicker::make('hora')
                    ->required(),
                TextInput::make('lugar'),
                TextInput::make('tipo_evento'),
                TextInput::make('invitados')
                    ->numeric(),
                TextInput::make('costo')
                    ->numeric(),
                TextInput::make('cliente_id')
                    ->required()
                    ->numeric(),
                TextInput::make('estado')
                    ->required()
                    ->default('Pendiente'),
            ]);
    }
}
