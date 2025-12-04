<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Cliente;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Clientes extends Component
{
    use WithPagination;

    public $modal = false;

    public $cliente_id;
    public $nombre;
    public $email;
    public $telefono;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'telefono' => 'nullable|string|max:20',
    ];

    // ------------------------------------
    // Render
    // ------------------------------------
    public function render()
    {
        return view('livewire.clientes', [
            'clientes' => Cliente::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    // ------------------------------------
    // Abrir modal (Crear)
    // ------------------------------------
    public function crear()
    {
        $this->resetInput();
        $this->modal = true;
    }

    // ------------------------------------
    // Abrir modal (Editar)
    // ------------------------------------
    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);

        $this->cliente_id = $cliente->id;
        $this->nombre     = $cliente->nombre;
        $this->email      = $cliente->email;
        $this->telefono   = $cliente->telefono;

        $this->modal = true;
    }

    // ------------------------------------
    // Guardar o actualizar
    // ------------------------------------
    public function guardar()
    {
        $this->validate();

        Cliente::updateOrCreate(
            ['id' => $this->cliente_id],
            [
                'nombre'   => $this->nombre,
                'email'    => $this->email,
                'telefono' => $this->telefono,
            ]
        );

        $this->cerrarModal();
    }

    // ------------------------------------
    // Eliminar
    // ------------------------------------
    public function eliminar($id)
    {
        Cliente::find($id)?->delete();
    }

    // ------------------------------------
    // Cerrar modal (FALTABA ESTE)
    // ------------------------------------
    public function cerrarModal()
    {
        $this->modal = false;
        $this->resetInput();
    }

    // ------------------------------------
    // Resetear inputs
    // ------------------------------------
    public function resetInput()
    {
        $this->cliente_id = null;
        $this->nombre     = '';
        $this->email      = '';
        $this->telefono   = '';
    }
}
