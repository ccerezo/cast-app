<?php

namespace App\Http\Livewire\TipoCliente;

use App\Models\TipoCliente;
use Livewire\Component;
use Livewire\WithPagination;

class TipoClienteIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $tipos = TipoCliente::where('tipo', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.tipo-cliente.tipo-cliente-index', compact('tipos'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
