<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'cliente_id',
        'servicio_id', // NUEVO: Relación con servicios (tipo de evento)
        'titulo',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'tipo_evento', // Mantener por compatibilidad
        'invitados',
        'costo',
        'estado',
    ];

    /** RELACIÓN: Un evento pertenece a un cliente */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /** NUEVA RELACIÓN: Un evento tiene un servicio/tipo */
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    /** CAPITALIZACIÓN AUTOMÁTICA */
    public function getTituloAttribute($value)
    {
        return ucwords($value);
    }

    public function getLugarAttribute($value)
    {
        return ucwords($value);
    }

    public function getTipoEventoAttribute($value)
    {
        // Si tiene servicio asociado, usar el nombre del servicio
        if ($this->servicio) {
            return $this->servicio->nombre;
        }
        return ucwords($value);
    }
}