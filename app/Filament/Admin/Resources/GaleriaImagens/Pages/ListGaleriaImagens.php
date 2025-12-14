<?php

namespace App\Filament\Admin\Resources\GaleriaImagens\Pages;

use App\Filament\Admin\Resources\GaleriaImagens\GaleriaImagenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGaleriaImagens extends ListRecords
{
    protected static string $resource = GaleriaImagenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
