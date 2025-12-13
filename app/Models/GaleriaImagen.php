<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriaImagen extends Model
{
    protected $table = 'galeria_imagenes';
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo_evento',
        'categoria', 
        'imagen',
        'destacada',
        'orden',
        'embed_code_instagram',
        'archivo_video',
    ];

    protected $casts = [
        'destacada' => 'boolean',
    ];

    /**
     * Scope para imágenes destacadas
     */
    public function scopeDestacadas($query)
    {
        return $query->where('destacada', true)->orderBy('orden');
    }

    /**
     * Scope por tipo de evento
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_evento', $tipo)->orderBy('orden');
    }

    /**
     * Scope por categoría
     */
    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria)->orderBy('orden');
    }

    /**
     * Obtener URL completa de la imagen
     */
    public function getImagenUrlAttribute()
    {
        return asset('storage/galeria/' . $this->imagen);
    }
}