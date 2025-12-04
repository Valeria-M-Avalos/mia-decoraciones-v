<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'fecha_reserva',
        'cliente_id',
        'evento_id',
        'senia',
        'total',
        'estado',
        'metodo_pago',
        'observaciones',
    ];

    // RELACIÓN con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // RELACIÓN con Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    // FORMATO AUTOMÁTICO
    public function getMetodoPagoAttribute($value)
    {
        return $value ? ucwords($value) : null;
    }

    public function getEstadoAttribute($value)
    {
        return ucfirst($value);
    }
}
