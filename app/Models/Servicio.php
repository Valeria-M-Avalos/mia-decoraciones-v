<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'icono',
        'imagen',
        'descripcion',
        'precio',
        'categoria'
    ];

    // Capitalizar automáticamente
    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }

    // Scope por categoría
    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    // Obtener URL de imagen
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/servicios/' . $this->imagen);
        }
        return null;
    }
}