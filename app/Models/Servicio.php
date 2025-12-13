<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio'
    ];

    // Capitalizar automáticamente
    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }

    public function eventos()
{
    return $this->belongsToMany(Evento::class, 'evento_servicio')
                ->withPivot(['cantidad', 'precio'])
                ->withTimestamps();
}

}

