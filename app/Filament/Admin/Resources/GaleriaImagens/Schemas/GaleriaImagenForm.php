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
                    ->label('Código de Incrustación de Instagram/Video')
                    ->rows(4)
                    ->helperText('Pega aquí el código HTML completo de Instagram (Embed Code).')
                    ->columnSpanFull(),
                
                Select::make('tipo_evento')
                    ->label('Tipo de Evento')
                    ->options([
                        'cumpleaños' => '🎂 Cumpleaños',
                        'Casamiento' => '💍 Casamiento',
                        'xv_años' => '✨ XV Años',
                        'bautizo' => '🎁 Otros Eventos',
                    ])
                    ->required(),
                
                Select::make('categoria')
                    ->label('Carpeta / Categoría')
                    ->options([
                        'cumpleanos' => '📁 Cumpleaños',
                        'casamiento' => '📁 Casamiento',
                        'xv_anos' => '📁 XV Años',
                        'decoracion' => '📁 Decoración General',
                        'otros' => '📁 Otros Eventos',
                        
                    ])
                    ->default('general')
                    ->required(),
                
                FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('galeria')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120)
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Formatos: JPG, PNG, GIF, WebP. Máximo 5MB'),

                FileUpload::make('archivo_video')
                    ->label('Subir Archivo de Video')
                    ->disk('public')
                    ->directory('galeria-videos') // Los archivos se guardarán en storage/app/public/galeria-videos
                    ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/webm']) // Tipos de video comunes
                    ->maxSize(50240) // 50MB (Ajusta este límite según tus necesidades de hosting)
                    ->columnSpanFull()
                    ->helperText('Sube un archivo de video (MP4, MOV, WebM). Máximo 50MB.'),
                
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