<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Decoración Temática',
                'icono' => '🎨',
                'descripcion' => 'Diseños personalizados que transforman tu evento en una experiencia única e inolvidable.',
                'precio' => 15000.00,
                'categoria' => 'decoracion',
            ],
            [
                'nombre' => 'Ambiente Climatizado',
                'icono' => '❄️',
                'descripcion' => 'Confort perfecto en cualquier época del año con aire acondicionado y calefacción.',
                'precio' => 8000.00,
                'categoria' => 'confort',
            ],
            [
                'nombre' => 'DJ y Sonido Profesional',
                'icono' => '🎵',
                'descripcion' => 'Equipos de audio de alta calidad y DJs experimentados para hacer bailar a todos.',
                'precio' => 12000.00,
                'categoria' => 'entretenimiento',
            ],
            [
                'nombre' => 'Vajilla y Mantelería',
                'icono' => '🍽️',
                'descripcion' => 'Vajilla elegante y mantelería de primera calidad en diversos colores y estilos.',
                'precio' => 5000.00,
                'categoria' => 'mobiliario',
            ],
            [
                'nombre' => 'Catering Personalizado',
                'icono' => '🎂',
                'descripcion' => 'Menús elaborados con productos frescos adaptados a tus gustos y necesidades.',
                'precio' => 25000.00,
                'categoria' => 'gastronomia',
            ],
            [
                'nombre' => 'Iluminación LED',
                'icono' => '💡',
                'descripcion' => 'Iluminación ambiental con tecnología LED para crear la atmósfera perfecta.',
                'precio' => 7000.00,
                'categoria' => 'decoracion',
            ],
            [
                'nombre' => 'Fotografía y Video',
                'icono' => '📸',
                'descripcion' => 'Capturamos cada momento especial con equipos profesionales y edición de alta calidad.',
                'precio' => 18000.00,
                'categoria' => 'multimedia',
            ],
            [
                'nombre' => 'Animación Infantil',
                'icono' => '🎪',
                'descripcion' => 'Animadores profesionales, juegos, inflables y diversión garantizada para los más pequeños.',
                'precio' => 10000.00,
                'categoria' => 'entretenimiento',
            ],
            [
                'nombre' => 'Candy Bar',
                'icono' => '🍬',
                'descripcion' => 'Mesa de dulces decorada con golosinas, postres y detalles personalizados.',
                'precio' => 6000.00,
                'categoria' => 'gastronomia',
            ],
            [
                'nombre' => 'Mobiliario Premium',
                'icono' => '🪑',
                'descripcion' => 'Sillas, mesas y mobiliario elegante para complementar la decoración de tu evento.',
                'precio' => 8000.00,
                'categoria' => 'mobiliario',
            ],
            [
                'nombre' => 'Servicio de Bar',
                'icono' => '🍸',
                'descripcion' => 'Barra completa con bartenders profesionales y amplia variedad de bebidas.',
                'precio' => 14000.00,
                'categoria' => 'gastronomia',
            ],
            [
                'nombre' => 'Coordinación de Evento',
                'icono' => '📋',
                'descripcion' => 'Coordinamos cada detalle para que solo te preocupes por disfrutar tu celebración.',
                'precio' => 9000.00,
                'categoria' => 'organizacion',
            ],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
