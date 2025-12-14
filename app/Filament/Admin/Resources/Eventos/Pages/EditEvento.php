<?php

namespace App\Filament\Admin\Resources\Eventos\Pages;

use App\Filament\Admin\Resources\Eventos\EventoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEvento extends EditRecord
{
    protected static string $resource = EventoResource::class;

    protected array $serviciosPivot = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // ✅ Cargar servicios existentes del pivot al repeater
        $data['servicios'] = $this->record->servicios->map(function ($s) {
            return [
                'servicio_id' => $s->id,
                'cantidad'    => $s->pivot->cantidad ?? 1,
                'precio'      => $s->pivot->precio ?? 0,
            ];
        })->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->serviciosPivot = $data['servicios'] ?? [];
        unset($data['servicios']);

        return $data;
    }

    protected function afterSave(): void
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

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
