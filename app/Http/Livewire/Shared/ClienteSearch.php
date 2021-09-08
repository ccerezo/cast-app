<?php

namespace App\Http\Livewire\Shared;

use App\Models\Cliente;
use Livewire\Component;

class ClienteSearch extends Component
{
    public $query;
    public $clientes;
    public $clienteSeleccionado;
    public $highlightIndex;

    public function mount()
    {
        $this->resetear();
    }

    public function resetear()
    {
        //$this->query = '';
        $this->clientes = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->clientes) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->clientes) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectCliente()
    {
        $cliente = $this->clientes[$this->highlightIndex] ?? null;
        if ($cliente) {
            $this->query = $cliente['identificacion'].' - '.$cliente['nombre'];
            $this->emit('updateDetalleCliente',  $cliente['id']);
            $this->resetear();
            $this->clienteSeleccionado = true;
        }
    }

    public function selectClienteClick($i)
    {
        $this->highlightIndex = $i;
        $cliente = $this->clientes[$this->highlightIndex] ?? null;
        if ($cliente) {
            $this->query = $cliente['identificacion'].' - '.$cliente['nombre'];
            $this->emit('updateDetalleCliente',  $cliente['id']);
            $this->resetear();
            $this->clienteSeleccionado = true;
            //$this->clientes = null;
        }
    }

    public function updatedQuery()
    {
        if($this->query) {
            $this->clienteSeleccionado = false;
            $this->clientes = Cliente::where('nombre', 'like', '%' . $this->query . '%')
                                ->orWhere('identificacion', 'like', '%' . $this->query . '%')
                                ->get()
                                ->toArray();
        } else {
            $this->emit('updateDetalleCliente',  null);
        }

    }

    public function render()
    {
        return view('livewire.shared.cliente-search');
    }
}
