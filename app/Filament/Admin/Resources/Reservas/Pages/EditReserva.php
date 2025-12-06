<?php

namespace App\Filament\Admin\Resources\Reservas\Pages;

use App\Filament\Admin\Resources\Reservas\ReservaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReserva extends EditRecord
{
    protected static string $resource = ReservaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
