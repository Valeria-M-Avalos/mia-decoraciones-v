<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class Dashboard extends Component
{
    public $totalEventos = 0;
    public $eventosPendientes = 0;
    public $totalClientes = 0;
    public $proximosEventos = [];

    public function mount()
    {
        // Total eventos
        try {
            $this->totalEventos = Evento::count();
        } catch (\Throwable $e) {
            $this->totalEventos = 0;
        }

        // Eventos pendientes (si existiera columna 'estado' o 'status')
        try {
            $table = (new Evento)->getTable();
            if (Schema::hasColumn($table, 'estado')) {
                $this->eventosPendientes = Evento::where('estado', 'pendiente')->count();
            } elseif (Schema::hasColumn($table, 'status')) {
                $this->eventosPendientes = Evento::where('status', 'pending')->count();
            } else {
                $this->eventosPendientes = 0;
            }
        } catch (\Throwable $e) {
            $this->eventosPendientes = 0;
        }

        // Total clientes
        try {
            $this->totalClientes = Cliente::count();
        } catch (\Throwable $e) {
            $this->totalClientes = 0;
        }

        // Detectar columna de fecha en Events (flexible)
        $dateColumn = null;
        try {
            $possible = ['fecha', 'date', 'event_date', 'start_date'];
            $table = (new Evento)->getTable();
            foreach ($possible as $col) {
                if (Schema::hasColumn($table, $col)) {
                    $dateColumn = $col;
                    break;
                }
            }
        } catch (\Throwable $e) {
            $dateColumn = null;
        }

        // Consultar próximos eventos (orden ascendente por la columna encontrada)
        try {
            $query = Evento::query();
            if ($dateColumn) {
                $query->whereNotNull($dateColumn)->orderBy($dateColumn, 'asc');
            } elseif (Schema::hasColumn((new Evento)->getTable(), 'created_at')) {
                $query->orderBy('created_at', 'asc');
            }
            $rows = $query->take(5)->get();
            $this->proximosEventos = $rows->map(function($ev) use ($dateColumn) {
                $titulo = $ev->title ?? $ev->titulo ?? $ev->name ?? 'Evento';
                $fechaRaw = $dateColumn ? ($ev->{$dateColumn} ?? null) : ($ev->date ?? ($ev->fecha ?? null));
                $fecha = $fechaRaw ? Carbon::parse($fechaRaw)->format('Y-m-d') : '-';
                $descripcion = $ev->details ?? $ev->descripcion ?? $ev->description ?? '';
                return (object)[
                    'titulo' => $titulo,
                    'fecha' => $fecha,
                    'descripcion' => $descripcion,
                ];
            })->toArray();
        } catch (\Throwable $e) {
            $this->proximosEventos = [];
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
