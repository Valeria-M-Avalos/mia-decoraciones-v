<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'tipo_evento',
        'fecha_evento',
        'mensaje',
        'estado',
        'notas_admin',
    ];

    protected $casts = [
        'fecha_evento' => 'date',
    ];

    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }

    public function getTipoEventoAttribute($value)
    {
        return ucwords($value);
    }
}