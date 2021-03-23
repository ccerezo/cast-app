<?php

namespace App\Http\Livewire\EstadoFactura;

use App\Models\EstadoFactura;
use Livewire\Component;
use Livewire\WithPagination;

class EstadoFacturaIndex extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $estados = EstadoFactura::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.estado-factura.estado-factura-index', compact('estados'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
