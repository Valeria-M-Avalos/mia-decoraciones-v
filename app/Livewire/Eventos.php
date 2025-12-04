<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Evento;
use App\Models\Cliente;

#[Layout('components.layouts.app')]
class Eventos extends Component
{
    use WithPagination;

    public $modal = false;

    public $filtro_cliente = '';
    public $filtro_estado = '';
    public $busqueda = '';

    // ORDEN
    public $sortField = 'fecha';   // antes 'id' si querés
    public $sortDirection = 'asc';

    public $evento_id;
    public $titulo;
    public $descripcion;
    public $fecha;
    public $hora;
    public $lugar;
    public $tipo_evento;
    public $invitados;
    public $costo;
    public $cliente_id;
    public $estado = 'pendiente';

    protected $rules = [
        'titulo'      => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'fecha'       => 'required|date',
        'hora'        => 'required',
        'lugar'       => 'required|string|max:255',
        'tipo_evento' => 'nullable|string|max:255',
        'invitados'   => 'nullable|integer|min:1',
        'costo'       => 'nullable|numeric|min:0',
        'cliente_id'  => 'nullable|exists:clientes,id',
        'estado'      => 'required|in:pendiente,confirmado,cancelado',
    ];

    protected $messages = [
        'cliente_id.exists' => 'El cliente seleccionado no existe.',
    ];

    public function render()
    {
        $query = Evento::query();

        // FILTRO POR CLIENTE
        if ($this->filtro_cliente != '') {
            $query->where('cliente_id', $this->filtro_cliente);
        }

        // FILTRO POR ESTADO
        if ($this->filtro_estado != '') {
            $query->where('estado', $this->filtro_estado);
        }

        // BUSCADOR GENERAL (título / lugar)
        if ($this->busqueda != '') {
            $query->where(function ($q) {
                $q->where('titulo', 'like', "%{$this->busqueda}%")
                  ->orWhere('lugar', 'like', "%{$this->busqueda}%");
            });
        }

        // ✅ APLICAMOS ORDEN DINÁMICO
        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.eventos', [
            'eventos'  => $query->paginate(10),
            'clientes' => Cliente::orderBy('nombre')->get(),
        ]);
    }

    // ------------------------------------------------
    // Abrir modal para crear
    // ------------------------------------------------
    public function crear()
    {
        $this->resetInput();
        $this->modal = true;
    }

    // ------------------------------------------------
    // Abrir modal para editar
    // ------------------------------------------------
    public function editar($id)
    {
        $evento = Evento::findOrFail($id);

        $this->evento_id   = $evento->id;
        $this->titulo      = $evento->titulo;
        $this->descripcion = $evento->descripcion;
        $this->fecha       = $evento->fecha;
        $this->hora        = $evento->hora;
        $this->lugar       = $evento->lugar;
        $this->tipo_evento = $evento->tipo_evento;
        $this->invitados   = $evento->invitados;
        $this->costo       = $evento->costo;
        $this->cliente_id  = $evento->cliente_id;
        $this->estado      = $evento->estado;

        $this->modal = true;
    }

    // ------------------------------------------------
    // Guardar o actualizar evento
    // ------------------------------------------------
    public function guardar()
    {
        $this->validate();

        Evento::updateOrCreate(
            ['id' => $this->evento_id],
            [
                'titulo'      => $this->titulo,
                'descripcion' => $this->descripcion,
                'fecha'       => $this->fecha,
                'hora'        => $this->hora,
                'lugar'       => $this->lugar,
                'tipo_evento' => $this->tipo_evento,
                'invitados'   => $this->invitados,
                'costo'       => $this->costo,
                'cliente_id'  => $this->cliente_id,
                'estado'      => $this->estado,
            ]
        );

        $this->cerrarModal();
    }

    // ------------------------------------------------
    // Eliminar
    // ------------------------------------------------
    public function eliminar($id)
    {
        Evento::find($id)?->delete();
    }

    // ------------------------------------------------
    // Cerrar modal
    // ------------------------------------------------
    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetInput();
    }

    // ------------------------------------------------
    // Limpiar propiedades
    // ------------------------------------------------
    public function resetInput()
    {
        $this->evento_id   = null;
        $this->titulo      = '';
        $this->descripcion = '';
        $this->fecha       = '';
        $this->hora        = '';
        $this->lugar       = '';
        $this->tipo_evento = '';
        $this->invitados   = '';
        $this->costo       = '';
        $this->cliente_id  = null;
        $this->estado      = 'pendiente';
    }

    // ------------------------------------------------
    // ORDENAR POR COLUMNA
    // ------------------------------------------------
    public function ordenarPor($campo)
    {
        if ($this->sortField === $campo) {
            // Si hago click de nuevo, invierto la dirección
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Si cambio de columna, empiezo en ascendente
            $this->sortField = $campo;
            $this->sortDirection = 'asc';
        }
    }
}
