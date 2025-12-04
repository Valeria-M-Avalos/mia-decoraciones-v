<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Evento;

#[Layout('components.layouts.app')]
class Reservas extends Component
{
    use WithPagination;

    public $modal = false;

    // Filtros
    public $filtro_cliente = '';
    public $filtro_estado = '';

    // Datos de la reserva
    public $reserva_id;
    public $fecha_reserva;
    public $cliente_id;
    public $evento_id;
    public $senia = 0;
    public $total = 0;
    public $estado = 'pendiente';
    public $metodo_pago;
    public $observaciones;

    // Validaciones
    protected $rules = [
        'fecha_reserva' => 'required|date',
        'cliente_id'    => 'nullable|exists:clientes,id',
        'evento_id'     => 'nullable|exists:eventos,id',
        'senia'         => 'nullable|numeric|min:0',
        'total'         => 'nullable|numeric|min:0',
        'estado'        => 'required|in:pendiente,confirmada,cancelada',
        'metodo_pago'   => 'nullable|string|max:255',
        'observaciones' => 'nullable|string',
    ];

    // ================================
    // RENDER
    // ================================
    public function render()
    {
        $query = Reserva::query();

        if ($this->filtro_cliente != '') {
            $query->where('cliente_id', $this->filtro_cliente);
        }

        if ($this->filtro_estado != '') {
            $query->where('estado', $this->filtro_estado);
        }

        return view('livewire.reservas', [
            'reservas' => $query->orderBy('fecha_reserva', 'desc')->paginate(10),
            'clientes' => Cliente::orderBy('nombre')->get(),
            'eventos'  => Evento::orderBy('fecha')->get(),
        ]);
    }

    // ================================
    // CÁLCULO AUTOMÁTICO DEL TOTAL
    // ================================
    public function calcularTotal()
    {
        $evento = Evento::find($this->evento_id);

        if ($evento) {
            $costo = floatval($evento->costo ?? 0);
            $senia = floatval($this->senia ?? 0);

            $this->total = max($costo - $senia, 0);
        }
    }

    // Cuando cambia el evento
    public function updatedEventoId()
    {
        $this->calcularTotal();
    }

    // Cuando cambia la seña
    public function updatedSenia()
    {
        $this->calcularTotal();
    }

    // ================================
    // MODAL CREAR
    // ================================
    public function crear()
    {
        $this->resetInput();
        $this->modal = true;
    }

    // ================================
    // MODAL EDITAR
    // ================================
    public function editar($id)
    {
        $r = Reserva::findOrFail($id);

        $this->reserva_id   = $r->id;
        $this->fecha_reserva = $r->fecha_reserva;
        $this->cliente_id    = $r->cliente_id;
        $this->evento_id     = $r->evento_id;
        $this->senia         = $r->senia;
        $this->total         = $r->total;
        $this->estado        = $r->estado;
        $this->metodo_pago   = $r->metodo_pago;
        $this->observaciones = $r->observaciones;

        $this->modal = true;
    }

    // ================================
    // GUARDAR
    // ================================
    public function guardar()
    {
        // Calcula total por seguridad antes de guardar
        $this->calcularTotal();

        $this->validate();

        Reserva::updateOrCreate(
            ['id' => $this->reserva_id],
            [
                'fecha_reserva' => $this->fecha_reserva,
                'cliente_id'    => $this->cliente_id,
                'evento_id'     => $this->evento_id,
                'senia'         => $this->senia,
                'total'         => $this->total,
                'estado'        => $this->estado,
                'metodo_pago'   => $this->metodo_pago,
                'observaciones' => $this->observaciones,
            ]
        );

        $this->cerrarModal();
    }

    // ================================
    // ELIMINAR
    // ================================
    public function eliminar($id)
    {
        Reserva::find($id)?->delete();
    }

    // ================================
    // CERRAR MODAL
    // ================================
    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetInput();
    }

    // ================================
    // RESET INPUT
    // ================================
    public function resetInput()
    {
        $this->reserva_id = null;
        $this->fecha_reserva = '';
        $this->cliente_id = '';
        $this->evento_id = '';
        $this->senia = 0;
        $this->total = 0;
        $this->estado = 'pendiente';
        $this->metodo_pago = '';
        $this->observaciones = '';
    }
}

