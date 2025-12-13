<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
    'apellido',
    'email',
    'telefono',
    ];

    // Capitaliza el nombre automáticamente al mostrarlo
    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }
}
