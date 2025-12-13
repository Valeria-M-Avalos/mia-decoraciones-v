<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoServicio extends Model
{
    protected $table = 'evento_servicio';

    protected $fillable = [
        'evento_id',
        'servicio_id',
        'cantidad',
        'precio',
        'descripcion_personalizada',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
