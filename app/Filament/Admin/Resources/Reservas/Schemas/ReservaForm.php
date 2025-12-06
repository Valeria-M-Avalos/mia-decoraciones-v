<?php

namespace App\Filament\Admin\Resources\Reservas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReservaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('fecha_reserva')
                    ->required(),
                TextInput::make('cliente_id')
                    ->numeric(),
                TextInput::make('evento_id')
                    ->numeric(),
                TextInput::make('senia')
                    ->numeric(),
                TextInput::make('total')
                    ->numeric(),
                Select::make('estado')
                    ->options(['pendiente' => 'Pendiente', 'confirmada' => 'Confirmada', 'cancelada' => 'Cancelada'])
                    ->default('pendiente')
                    ->required(),
                TextInput::make('metodo_pago'),
                Textarea::make('observaciones')
                    ->columnSpanFull(),
            ]);
    }
}
