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
        'costo_base',
        'costo_por_invitado',
        'costo',
        'estado',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($evento) {
            if ($evento->costo_base !== null && $evento->costo_por_invitado !== null) {
                $evento->costo = $evento->costo_base + ($evento->invitados * $evento->costo_por_invitado);
            }
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'evento_servicio')
            ->withPivot(['cantidad', 'precio'])
            ->withTimestamps();
    }

    public function getTituloAttribute($value)
    {
        return ucwords($value);
    }

    public function getLugarAttribute($value)
    {
        return ucwords($value);
    }

public function getCostoGeneralAttribute(): float
{
    $totalServicios = $this->servicios->sum(function ($servicio) {
        return ($servicio->pivot->cantidad ?? 1) * ($servicio->pivot->precio ?? 0);
    });

    return ($this->costo ?? 0) + $totalServicios;
}

}
