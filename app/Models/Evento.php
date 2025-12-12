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
                $evento->costo =
                    $evento->costo_base + ($evento->invitados * $evento->costo_por_invitado);
            }
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // 🔥 RELACIÓN CORRECTA PARA EL REPEATER
    public function servicios()
    {
        return $this->hasMany(EventoServicio::class); // ← YA NO ES belongsToMany
    }

    public function getTituloAttribute($value)
    {
        return ucwords($value);
    }

    public function getLugarAttribute($value)
    {
        return ucwords($value);
    }
}
