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
     * CORREGIDO: Obtener URL completa de la imagen
     * Si la BD ya tiene "galeria/imagen.jpg", NO duplicamos
     */
    public function getImagenUrlAttribute()
    {
        if (empty($this->imagen)) {
            return null;
        }

        // Si ya contiene "galeria/", solo agregamos storage/
        if (str_starts_with($this->imagen, 'galeria/')) {
            return asset('storage/' . $this->imagen);
        }

        // Si no, agregamos la ruta completa
        return asset('storage/galeria/' . $this->imagen);
    }

    /**
     * Normalizar tipo_evento al guardar (siempre en minúsculas sin acentos)
     */
    public function setTipoEventoAttribute($value)
    {
        $this->attributes['tipo_evento'] = $this->normalizarSlug($value);
    }

    /**
     * Normalizar categoría al guardar
     */
    public function setCategoriaAttribute($value)
    {
        $this->attributes['categoria'] = $this->normalizarSlug($value);
    }

    /**
     * Función auxiliar para normalizar slugs
     */
    private function normalizarSlug($value)
    {
        $normalizado = strtolower($value);
        
        // Reemplazar caracteres especiales
        $normalizado = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü', ' ', 'ñ'],
            ['a', 'e', 'i', 'o', 'u', 'n', 'u', '_', 'n'],
            $normalizado
        );

        // Casos especiales
        $mapeo = [
            'cumpleaños' => 'cumpleanos',
            'casamiento' => 'casamiento',
            'casamientos' => 'casamiento',
            'boda' => 'casamiento',
            'bodas' => 'casamiento',
            'xv_años' => 'xv_anos',
            'xv_a_os' => 'xv_anos',
            'xv años' => 'xv_anos',
            'quince_años' => 'xv_anos',
            'quinceañera' => 'xv_anos',
            'bautizo' => 'otros_eventos',
            'bautismo' => 'otros_eventos',
            'comunion' => 'otros_eventos',
            'baby_shower' => 'otros_eventos',
            'otros' => 'otros_eventos',
            'otro' => 'otros_eventos',
        ];

        return $mapeo[$normalizado] ?? $normalizado;
    }
}