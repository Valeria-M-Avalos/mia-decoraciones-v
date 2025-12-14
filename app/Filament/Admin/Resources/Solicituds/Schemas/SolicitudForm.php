<?php

namespace App\Filament\Admin\Resources\Solicituds\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SolicitudForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre Completo')
                    ->required()
                    ->disabled(),
                
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->disabled(),
                
                TextInput::make('telefono')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                    ->disabled(),
                
                TextInput::make('tipo_evento')
                    ->label('Tipo de Evento')
                    ->required()
                    ->disabled(),
                
                DatePicker::make('fecha_evento')
                    ->label('Fecha del Evento')
                    ->disabled(),
                
                Textarea::make('mensaje')
                    ->label('Mensaje del Cliente')
                    ->rows(5)
                    ->disabled()
                    ->columnSpanFull(),
                
                Select::make('estado')
                    ->label('Estado de la Solicitud')
                    ->options([
                        'pendiente' => '⏳ Pendiente',
                        'contactado' => '📞 Contactado',
                        'convertido' => '✅ Convertido en Cliente',
                        'descartado' => '❌ Descartado',
                    ])
                    ->required()
                    ->default('pendiente')
                    ->columnSpanFull(),
                
                Textarea::make('notas_admin')
                    ->label('Notas Internas (Solo Admin)')
                    ->rows(4)
                    ->helperText('Agrega notas sobre el seguimiento de esta solicitud')
                    ->columnSpanFull(),
            ]);
    }
}
