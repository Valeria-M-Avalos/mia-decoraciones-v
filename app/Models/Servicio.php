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

    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }

    // 🔥 Relación opcional (solo para consulta)
    public function eventoServicios()
    {
        return $this->hasMany(EventoServicio::class);
    }
}
