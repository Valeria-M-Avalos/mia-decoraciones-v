<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

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
    
    /**
     * Boot method para enviar notificación cuando se crea una solicitud
     */
    protected static function booted()
    {
        static::created(function ($solicitud) {
            // Enviar notificación a todos los usuarios admin
            $users = \App\Models\User::all();
            
            foreach ($users as $user) {
                Notification::make()
                    ->title('Nueva Solicitud Recibida')
                    ->body("**{$solicitud->nombre}** solicita información sobre {$solicitud->tipo_evento}")
                    ->icon('heroicon-o-envelope')
                    ->iconColor('success')
                    ->sendToDatabase($user);
            }
        });
    }
}