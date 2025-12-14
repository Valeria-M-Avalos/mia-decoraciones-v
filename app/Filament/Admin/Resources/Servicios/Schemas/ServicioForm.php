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
                    
                FileUpload::make('imagen_destacada') // El nombre coincide con la columna de BD
                    ->label('Imagen de Portada para la Web')
                    ->disk('public') // CRÍTICO: Usa el disco 'public'
                    ->directory('servicios-portadas') // Carpeta dentro de storage/app/public
                    ->image() 
                    ->imageEditor()
                    ->columnSpan(1),

                TextInput::make('precio')
                    ->numeric(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }
}