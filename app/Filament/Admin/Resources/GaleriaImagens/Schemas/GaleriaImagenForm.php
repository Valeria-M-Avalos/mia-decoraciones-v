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
                
                Textarea::make('embed_code_instagram')
                    ->label('Código de Incrustación de Instagram/Video (Opcional)')
                    ->helperText('Pega aquí el código HTML completo que te da Instagram para incrustar el video.')
                    ->rows(5)
                    ->columnSpanFull(),

                Select::make('tipo_evento')
                    ->label('Tipo de Evento')
                    ->options([
                        'cumpleanos' => '🎂 Cumpleaños',
                        'casamiento' => '💍 Casamientos', 
                        'xv_anos' => '✨ XV Años',
                        'otros_eventos' => '🎁 Otros Eventos', 
                    ])
                    ->required(),
                
                Select::make('categoria')
                    ->label('Carpeta / Categoría')
                    ->options([
                        'cumpleanos' => '📁 Cumpleaños',
                        'casamiento' => '📁 Casamientos',
                        'xv_anos' => '📁 XV Años',
                        'decoracion' => '📁 Decoración General',
                        'otros_eventos' => '📁 Otros Eventos', 
                    ])
                    ->default('otros_eventos') 
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