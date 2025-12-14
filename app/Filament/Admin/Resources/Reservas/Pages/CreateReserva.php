<?php

namespace App\Filament\Admin\Resources\Reservas\Pages;

use App\Filament\Admin\Resources\Reservas\ReservaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReserva extends CreateRecord
{
    protected static string $resource = ReservaResource::class;

    // 👉 Esto hace que, al guardar, vuelva al formulario vacío
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('create');
    }
}
