<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Servicio;

#[Layout('components.layouts.app')]
class Servicios extends Component
{
    use WithPagination;

    public $modal = false;

    public $servicio_id;
    public $nombre;
    public $descripcion;
    public $precio;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'nullable|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.servicios', [
            'servicios' => Servicio::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    // Abrir modal para crear
    public function crear()
    {
        $this->resetInput();
        $this->modal = true;
    }

    // Abrir modal para editar
    public function editar($id)
    {
        $servicio = Servicio::findOrFail($id);

        $this->servicio_id = $servicio->id;
        $this->nombre = $servicio->nombre;
        $this->descripcion = $servicio->descripcion;
        $this->precio = $servicio->precio;

        $this->modal = true;
    }

    // Guardar o actualizar
    public function guardar()
    {
        $this->validate();

        Servicio::updateOrCreate(
            ['id' => $this->servicio_id],
            [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'precio' => $this->precio,
            ]
        );

        $this->cerrarModal();
    }

    // Eliminar
    public function eliminar($id)
    {
        Servicio::find($id)?->delete();
    }

    // Cerrar modal
    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetInput();
    }

    // Reset de inputs
    public function resetInput()
    {
        $this->servicio_id = null;
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
    }
}
