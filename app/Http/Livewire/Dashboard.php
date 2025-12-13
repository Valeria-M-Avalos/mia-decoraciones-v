<?php 

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

// Ajustá los nombres de modelos si en tu proyecto son distintos
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Evento;
use App\Models\Reserva;

class Dashboard extends Component
{
    // Propiedades públicas requeridas por la vista
    public $totalClientes = 0;
    public $totalReservas = 0;
    public $totalEventos = 0;
    public $totalServicios = 0;

    // Colección de próximos eventos (Collection de objetos)
    public $proximosEventos;

    // Actividad reciente (array simple)
    public $actividadReciente = [];

    public function mount()
    {
        // Conteos seguros
        try { $this->totalClientes = class_exists(Cliente::class) ? Cliente::count() : 0; } catch (\Throwable $e) { $this->totalClientes = 0; }
        try { $this->totalReservas = class_exists(Reserva::class) ? Reserva::count() : 0; } catch (\Throwable $e) { $this->totalReservas = 0; }
        try { $this->totalEventos = class_exists(Evento::class) ? Evento::count() : 0; } catch (\Throwable $e) { $this->totalEventos = 0; }
        try { $this->totalServicios = class_exists(Servicio::class) ? Servicio::count() : 0; } catch (\Throwable $e) { $this->totalServicios = 0; }

        // Detectar columna de fecha en Evento
        $dateColumn = null;
        try {
            if (class_exists(Evento::class)) {
                $table = (new Evento)->getTable();
                foreach (['fecha','date','event_date','start_date'] as $col) {
                    if (Schema::hasColumn($table, $col)) { $dateColumn = $col; break; }
                }
            }
        } catch (\Throwable $e) {
            $dateColumn = null;
        }

        // Obtener próximos eventos (máx 5) y mapear a formato esperado por la vista
        try {
            if (class_exists(Evento::class)) {
                $q = Evento::query();
                if ($dateColumn) {
                    $q->whereNotNull($dateColumn)->where($dateColumn, '>=', now())->orderBy($dateColumn, 'asc');
                } elseif (Schema::hasColumn((new Evento)->getTable(), 'created_at')) {
                    $q->orderBy('created_at', 'asc');
                }
                $rows = $q->take(5)->get();

                // <-- Mantener Collection en lugar de convertir a array
                $this->proximosEventos = $rows->map(function($ev) use ($dateColumn) {
                    // Nombre del evento
                    $nombre = $ev->nombre ?? $ev->titulo ?? $ev->title ?? $ev->name ?? 'Evento';

                    // Fecha formateada
                    $fechaRaw = $dateColumn ? ($ev->{$dateColumn} ?? null) : ($ev->fecha ?? ($ev->date ?? null));
                    $fecha = $fechaRaw ? Carbon::parse($fechaRaw)->format('d/m/Y') : '-';

                    // Cliente relacionado
                    $clienteNombre = null;
                    if (isset($ev->cliente) && is_object($ev->cliente)) {
                        $clienteNombre = $ev->cliente->nombre ?? $ev->cliente->name ?? null;
                    }
                    if (!$clienteNombre) {
                        $clienteNombre = $ev->cliente_nombre ?? $ev->cliente_name ?? null;
                    }
                    $clienteNombre = $clienteNombre ?? 'Sin asignar';

                    return (object)[
                        'nombre' => $nombre,
                        'fecha' => $fecha,
                        'cliente' => $clienteNombre,
                    ];
                }); // <-- ya no usamos ->toArray()
            } else {
                $this->proximosEventos = collect();
            }
        } catch (\Throwable $e) {
            $this->proximosEventos = collect();
        }

        // Actividad reciente: intenta armar a partir de reservas/eventos (últimas 5 acciones)
        try {
            $logs = [];
            if (class_exists(Reserva::class)) {
                $recent = Reserva::orderBy('created_at', 'desc')->take(5)->get();
                foreach ($recent as $r) {
                    $logs[] = [
                        'texto' => 'Reserva creada' . (isset($r->id) ? " #{$r->id}" : ''),
                        'fecha' => isset($r->created_at) ? Carbon::parse($r->created_at)->format('d/m/Y H:i') : '',
                    ];
                }
            }
            if (empty($logs) && class_exists(Evento::class)) {
                $recentE = Evento::orderBy('created_at', 'desc')->take(5)->get();
                foreach ($recentE as $e) {
                    $logs[] = [
                        'texto' => 'Evento: ' . ($e->nombre ?? $e->titulo ?? $e->title ?? 'Evento'),
                        'fecha' => isset($e->created_at) ? Carbon::parse($e->created_at)->format('d/m/Y H:i') : '',
                    ];
                }
            }
            $this->actividadReciente = $logs;
        } catch (\Throwable $e) {
            $this->actividadReciente = [];
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
