<?php

namespace App\Filament\Admin\Resources\GaleriaImagens\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GaleriaImagenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),
                
                Select::make('tipo_evento')
                    ->label('Tipo de Evento')
                    ->options([
                        'cumpleaños' => '🎂 Cumpleaños',
                        'boda' => '💍 Boda',
                        'xv_años' => '✨ XV Años',
                        'bautizo' => '🎁 Bautizo',
                    ])
                    ->required(),
                
                Select::make('categoria')
                    ->label('Carpeta / Categoría')
                    ->options([
                        'cumpleanos' => '📁 Cumpleaños',
                        'bodas' => '📁 Bodas',
                        'xv_anos' => '📁 XV Años',
                        'bautizos' => '📁 Bautizos',
                        'decoracion' => '📁 Decoración General',
                        'otros' => '📁 Otros Eventos',
                        'general' => '📁 General',
                    ])
                    ->default('general')
                    ->required(),
                
                FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->directory('galeria')
                    ->required()
                    ->columnSpanFull(),
                
                Toggle::make('destacada')
                    ->label('Mostrar en página principal')
                    ->default(false),
                
                TextInput::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
            ]);
    }
}