<?php

namespace App\Filament\Admin\Resources\Eventos\Pages;

use App\Filament\Admin\Resources\Eventos\EventoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvento extends CreateRecord
{
    protected static string $resource = EventoResource::class;

    protected array $serviciosPivot = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Guardamos servicios aparte y los sacamos del $data del evento
        $this->serviciosPivot = $data['servicios'] ?? [];
        unset($data['servicios']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $sync = [];

        foreach ($this->serviciosPivot as $item) {
            if (empty($item['servicio_id'])) continue;

            $sync[$item['servicio_id']] = [
                'cantidad' => $item['cantidad'] ?? 1,
                'precio'   => $item['precio'] ?? 0,
            ];
        }

        $this->record->servicios()->sync($sync);
    }

    // ✅ que vuelva al formulario para cargar otro
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('create');
    }
}
