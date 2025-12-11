<?php

namespace App\Http\Controllers;

use App\Models\GaleriaImagen;
use App\Models\Servicio;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Tipos de eventos que ofreces (USANDO SLUGS LIMPIOS PARA URLs y DB)
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
                'emoji' => '💍',
                'icono' => 'heroicon-o-heart',
            ],
            [
                'nombre' => 'XV Años',
                'slug' => 'xv_anos',
                'descripcion' => 'Quinceañeras de ensueño con decoraciones que reflejan tu personalidad.',
                'emoji' => '✨',
                'icono' => 'heroicon-o-sparkles',
            ],
            [
                'nombre' => 'Otros Eventos', 
                'slug' => 'otros_eventos',
                'descripcion' => 'Eventos personalizados que se adaptan a tu visión (incluye bautizos, comuniones, etc.).',
                'emoji' => '🎁',
                'icono' => 'heroicon-o-gift',
            ],
        ];

        // Obtener imágenes por tipo
        foreach ($tiposEventos as $tipo) {
            $imagenesPorTipo[$tipo['slug']] = GaleriaImagen::where('tipo_evento', $tipo['slug'])
                ->orWhere('categoria', $tipo['slug'])
                ->orderByDesc('destacada')
                ->take(1)
                ->first();
        }

        return view('public.servicios', compact('servicios', 'tiposEventos', 'imagenesPorTipo'));
    }

    /**
     * Muestra la página de detalle de un evento.
     */
    public function eventoDetalle($tipo)
    {
        // Mapeo de slugs a información del evento. **USANDO SLUGS LIMPIOS**
        $eventosInfo = [
            'cumpleanos' => [ 
                'titulo' => 'Cumpleaños', 
                'slug' => 'cumpleanos',
                'tipo_bd' => 'cumpleanos',
                'emoji' => '🎂',
                'descripcion' => 'Celebramos contigo cada año de vida con decoraciones únicas y personalizadas.',
                'historia' => 'Cada cumpleaños es una historia por contar. Transformamos tus ideas en realidad.',
            ],
            'casamiento' => [ 
                'titulo' => 'Casamientos',
                'slug' => 'casamiento',
                'tipo_bd' => 'casamiento',
                'emoji' => '💍',
                'descripcion' => 'El día más importante merece la decoración más hermosa.',
                'historia' => 'Cada casamiento es único. Creamos una decoración que cuente vuestra historia.',
            ],
            'xv_anos' => [ 
                'titulo' => 'XV Años',
                'slug' => 'xv_anos',
                'tipo_bd' => 'xv_anos',
                'emoji' => '✨',
                'descripcion' => 'Quinceañeras de ensueño que reflejan tu estilo.',
                'historia' => 'Diseñamos cada detalle para que brilles en tu noche especial.',
            ],
            'otros_eventos' => [
                'titulo' => 'Otros Eventos',
                'slug' => 'otros_eventos',
                'tipo_bd' => 'otros_eventos',
                'emoji' => '🎁',
                'descripcion' => 'Eventos personalizados que se adaptan a tu visión (Bautizos, Comuniones, etc.).',
                'historia' => 'Transformamos tus ideas en el ambiente perfecto.',
            ],
        ];

        if (!isset($eventosInfo[$tipo])) {
            abort(404);
        }

        $evento = $eventosInfo[$tipo];

        // Búsqueda de imágenes (usa el slug limpio)
        $imagenes = GaleriaImagen::where('categoria', $evento['slug'])
            ->orWhere('tipo_evento', $evento['tipo_bd']) 
            ->orderBy('orden')
            ->get();

        // Traer todos los servicios.
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