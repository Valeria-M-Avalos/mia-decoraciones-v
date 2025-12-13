<?php

namespace App\Enums;

class TipoEvento
{
    public static function options(): array
    {
        return [
            'cumpleanos' => 'Cumpleaños',
            '15' => '15 Años',
            'casamiento' => 'Casamiento',
            'bautismo' => 'Bautismo',
            'baby_shower' => 'Baby Shower',
            'reunion_familiar' => 'Reunión Familiar',
            'corporativo' => 'Corporativo',
            'otros' => 'Otros',
        ];
    }
}
