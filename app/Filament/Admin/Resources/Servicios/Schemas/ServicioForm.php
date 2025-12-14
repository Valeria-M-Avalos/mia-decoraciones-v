<?php

namespace App\Filament\Admin\Resources\Servicios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class ServicioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),

                TextInput::make('precio')
                    ->numeric(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }
}