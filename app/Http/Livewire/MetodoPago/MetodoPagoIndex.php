<?php

namespace App\Http\Livewire\MetodoPago;

use App\Models\MetodoPago;
use Livewire\Component;
use Livewire\WithPagination;

class MetodoPagoIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $metodos = MetodoPago::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->paginate();
        return view('livewire.metodo-pago.metodo-pago-index', compact('metodos'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
