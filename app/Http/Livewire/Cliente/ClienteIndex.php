<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direcction = 'desc';

    protected $listeners = ['render'];
    public function render()
    {
        $clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('identificacion', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate(10);
        return view('livewire.cliente.cliente-index', compact('clientes'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
