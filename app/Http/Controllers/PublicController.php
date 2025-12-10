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
        
        // Tipos de eventos que ofreces
        $tiposEventos = [
            [
                'nombre' => 'Cumpleaños',
                'slug' => 'cumpleaños',
                'descripcion' => 'Celebraciones únicas para todas las edades. Convertimos tus sueños en realidad.',
                'icono' => 'heroicon-o-cake',
            ],
            [
                'nombre' => 'Bodas',
                'slug' => 'boda',
                'descripcion' => 'El día más especial de tu vida merece una decoración inolvidable.',
                'icono' => 'heroicon-o-heart',
            ],
            [
                'nombre' => 'XV Años',
                'slug' => 'xv_años',
                'descripcion' => 'Quinceañeras de ensueño con decoraciones que reflejan tu personalidad.',
                'icono' => 'heroicon-o-sparkles',
            ],
            [
                'nombre' => 'Bautizos',
                'slug' => 'bautizo',
                'descripcion' => 'Momentos tiernos decorados con delicadeza y amor.',
                'icono' => 'heroicon-o-gift',
            ],
        ];
        
        // Obtener imágenes por tipo
        foreach ($tiposEventos as $tipo) {
            $imagenesPorTipo[$tipo['slug']] = GaleriaImagen::porTipo($tipo['slug'])->take(1)->first();
        }
        
        return view('public.servicios', compact('servicios', 'tiposEventos', 'imagenesPorTipo'));
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