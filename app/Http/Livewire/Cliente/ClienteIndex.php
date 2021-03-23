<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('identificacion', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.cliente.cliente-index', compact('clientes'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
