<?php

namespace App\Http\Controllers;

use App\Models\GaleriaImagen;
use App\Models\Servicio;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Página de inicio
     */
    public function index()
    {
        $servicios = Servicio::take(6)->get();
        $imagenesDestacadas = GaleriaImagen::destacadas()->take(6)->get();
        return view('public.index', compact('servicios', 'imagenesDestacadas'));
    }

    /**
     * Página de servicios/eventos
     */
    public function servicios()
    {
        $servicios = Servicio::all();
        $imagenesPorTipo = [];

        // ✅ CORREGIDO: Tipos de eventos normalizados
        $tiposEventos = [
            [
                'nombre' => 'Cumpleaños',
                'slug' => 'cumpleanos',
                'descripcion' => 'Celebraciones únicas para todas las edades. Convertimos tus sueños en realidad.',
                'emoji' => '🎂',
                'icono' => 'heroicon-o-cake',
            ],
            [
                'nombre' => 'Casamientos',
                'slug' => 'casamiento',
                'descripcion' => 'El día más especial de tu vida merece una decoración inolvidable.',
                'emoji' => '💒',
                'icono' => 'heroicon-o-heart',
            ],
            [
                'nombre' => 'XV Años',
                'slug' => 'xv_anos',
                'descripcion' => 'Quinceañeras de ensueño con decoraciones que reflejan tu personalidad.',
                'emoji' => '👑',
                'icono' => 'heroicon-o-sparkles',
            ],
            [
                'nombre' => 'Otros Eventos',
                'slug' => 'otros_eventos',
                'descripcion' => 'Eventos personalizados: bautizos, baby showers, comuniones y más.',
                'emoji' => '🎉',
                'icono' => 'heroicon-o-gift',
            ],
        ];

        // ✅ CORREGIDO: Obtener imágenes por tipo (busca por slug normalizado)
        foreach ($tiposEventos as $tipo) {
            $imagenesPorTipo[$tipo['slug']] = GaleriaImagen::where(function($query) use ($tipo) {
                $query->where('tipo_evento', $tipo['slug'])
                      ->orWhere('categoria', $tipo['slug']);
            })
            ->orderByDesc('destacada')
            ->orderBy('orden')
            ->first();
        }

        return view('public.servicios', compact('servicios', 'tiposEventos', 'imagenesPorTipo'));
    }

    /**
     * Muestra la página de detalle de un evento.
     */
    public function eventoDetalle($tipo)
    {
        // ✅ CORREGIDO: Mapeo normalizado
        $eventosInfo = [
            'cumpleanos' => [
                'titulo' => 'Cumpleaños',
                'slug' => 'cumpleanos',
                'emoji' => '🎂',
                'descripcion' => 'Celebramos contigo cada año de vida con decoraciones únicas y personalizadas.',
                'historia' => 'Cada cumpleaños es una historia por contar. Transformamos tus ideas en espacios mágicos llenos de color, alegría y detalles que hacen de tu celebración algo verdaderamente especial. Desde el primer añito hasta los cumpleaños más importantes, creamos ambientes que reflejan la personalidad del festejado.',
                'detalles' => [
                    '🎈 Decoración temática personalizada',
                    '🎂 Ambientación completa del salón',
                    '🎁 Mesa de dulces y candy bar',
                    '🎪 Espacios para juegos y entretenimiento',
                    '📸 Rincones instagrameables',
                    '✨ Iluminación ambiental',
                ],
            ],
            'casamiento' => [
                'titulo' => 'Casamientos',
                'slug' => 'casamiento',
                'emoji' => '💒',
                'descripcion' => 'El día más importante merece la decoración más hermosa.',
                'historia' => 'Cada casamiento es único y cuenta una historia de amor. Diseñamos cada detalle para que tu boda sea el reflejo perfecto de vuestra historia juntos. Desde la ceremonia hasta la recepción, creamos ambientes románticos y elegantes que harán de tu día el más memorable.',
                'detalles' => [
                    '💐 Decoración floral personalizada',
                    '🕯️ Iluminación romántica',
                    '🎊 Ambientación de ceremonia y salón',
                    '🍾 Decoración de mesas y sillas',
                    '💍 Espacios para fotos inolvidables',
                    '✨ Detalles exclusivos para novios',
                ],
            ],
            'xv_anos' => [
                'titulo' => 'XV Años',
                'slug' => 'xv_anos',
                'emoji' => '👑',
                'descripcion' => 'Quinceañeras de ensueño que reflejan tu estilo.',
                'historia' => 'Tus quince años son un momento único e irrepetible. Diseñamos cada detalle para que brilles en tu noche especial. Desde decoraciones de princesa hasta estilos modernos y elegantes, creamos el ambiente perfecto para tu celebración de ensueño.',
                'detalles' => [
                    '👑 Decoración temática exclusiva',
                    '💃 Pista de baile decorada',
                    '📷 Espacios fotográficos únicos',
                    '🎀 Mesa de honor especial',
                    '✨ Iluminación y efectos especiales',
                    '🎵 Ambientación musical',
                ],
            ],
            'otros_eventos' => [
                'titulo' => 'Otros Eventos',
                'slug' => 'otros_eventos',
                'emoji' => '🎉',
                'descripcion' => 'Eventos personalizados que se adaptan a tu visión: Bautizos, Baby Showers, Comuniones y más.',
                'historia' => 'Cada celebración es especial y merece una decoración única. Ya sea un bautizo, baby shower, comunión, aniversario o cualquier evento especial, diseñamos ambientes personalizados que reflejan el espíritu de la ocasión y crean momentos memorables para ti y tus invitados.',
                'detalles' => [
                    '👶 Bautizos y primeras comuniones',
                    '🍼 Baby showers temáticos',
                    '🎃 Fiestas temáticas (Halloween, Navidad)',
                    '💝 Aniversarios y celebraciones',
                    '🎓 Graduaciones',
                    '✨ Eventos corporativos pequeños',
                ],
            ],
        ];

        if (!isset($eventosInfo[$tipo])) {
            abort(404);
        }

        $evento = $eventosInfo[$tipo];

        // ✅ CORREGIDO: Búsqueda de imágenes normalizada
        $imagenes = GaleriaImagen::where(function($query) use ($evento) {
            $query->where('categoria', $evento['slug'])
                  ->orWhere('tipo_evento', $evento['slug']);
        })
        ->orderBy('orden')
        ->get();

        // Traer todos los servicios
        $servicios = Servicio::all();

        return view('public.evento-detalle', compact('evento', 'imagenes', 'servicios'));
    }

    /**
     * Página de contacto
     */
    public function contacto()
    {
        return view('public.contacto');
    }

    /**
     * Enviar formulario de contacto
     */
    public function enviarContacto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:20',
            'tipo_evento' => 'required|string',
            'fecha_evento' => 'nullable|date',
            'mensaje' => 'required|string',
        ]);

        // Guardar en la tabla solicitudes
        Solicitud::create([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'tipo_evento' => $validated['tipo_evento'],
            'fecha_evento' => $validated['fecha_evento'] ?? null,
            'mensaje' => $validated['mensaje'],
            'estado' => 'pendiente',
        ]);

        return redirect()->route('contacto')->with('success', '¡Gracias por contactarnos! Nos pondremos en contacto contigo pronto.');
    }
}