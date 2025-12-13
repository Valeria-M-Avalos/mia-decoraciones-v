<?php

namespace App\Filament\Admin\Resources\Eventos\Pages;

use App\Filament\Admin\Resources\Eventos\EventoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventos extends ListRecords
{
    protected static string $resource = EventoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
