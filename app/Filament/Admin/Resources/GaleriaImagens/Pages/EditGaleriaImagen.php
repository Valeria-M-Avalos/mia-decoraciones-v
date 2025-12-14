<?php

namespace App\Filament\Admin\Resources\GaleriaImagens\Pages;

use App\Filament\Admin\Resources\GaleriaImagens\GaleriaImagenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGaleriaImagen extends EditRecord
{
    protected static string $resource = GaleriaImagenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
