<?php

namespace App\Filament\Admin\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')->required(),
TextInput::make('apellido')->required(),

TextInput::make('email')->email(),
TextInput::make('telefono'),

            ]);
    }
}
