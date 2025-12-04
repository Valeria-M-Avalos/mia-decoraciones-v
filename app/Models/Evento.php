<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'cliente_id',
        'titulo',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'tipo_evento',
        'invitados',
        'costo',
        'estado',
    ];

    /** RELACIÓN: Un evento pertenece a un cliente */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
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
        return ucwords($value);
    }
}
