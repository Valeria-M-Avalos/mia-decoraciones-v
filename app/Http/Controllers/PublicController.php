<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
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
        return view('public.index', compact('servicios'));
    }

    /**
     * Página de servicios/eventos
     */
    public function servicios()
    {
        $servicios = Servicio::all();
        
        // Tipos de eventos que ofreces
        $tiposEventos = [
            [
                'nombre' => 'Cumpleaños',
                'descripcion' => 'Celebraciones únicas para todas las edades. Convertimos tus sueños en realidad.',
                'icono' => 'heroicon-o-cake',
                'imagen' => 'cumpleanos.jpg'
            ],
            [
                'nombre' => 'Bodas',
                'descripcion' => 'El día más especial de tu vida merece una decoración inolvidable.',
                'icono' => 'heroicon-o-heart',
                'imagen' => 'bodas.jpg'
            ],
            [
                'nombre' => 'XV Años',
                'descripcion' => 'Quinceañeras de ensueño con decoraciones que reflejan tu personalidad.',
                'icono' => 'heroicon-o-sparkles',
                'imagen' => 'xv-anos.jpg'
            ],
            [
                'nombre' => 'Bautizos',
                'descripcion' => 'Momentos tiernos decorados con delicadeza y amor.',
                'icono' => 'heroicon-o-gift',
                'imagen' => 'bautizos.jpg'
            ],
        ];
        
        return view('public.servicios', compact('servicios', 'tiposEventos'));
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

        // Aquí puedes agregar la lógica para enviar email o guardar en BD
        // Por ahora solo redirigimos con mensaje de éxito
        
        return redirect()->route('contacto')->with('success', '¡Gracias por contactarnos! Nos pondremos en contacto contigo pronto.');
    }
}