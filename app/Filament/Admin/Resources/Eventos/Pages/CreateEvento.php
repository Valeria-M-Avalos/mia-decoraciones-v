<?php

namespace App\Filament\Admin\Resources\Eventos\Pages;

use App\Filament\Admin\Resources\Eventos\EventoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvento extends CreateRecord
{
    protected static string $resource = EventoResource::class;

    /**
     * Redirige nuevamente al formulario
     * para permitir crear otro evento
     */
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('create');
    }
}
