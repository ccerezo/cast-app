<?php

namespace App\Http\Livewire\Factura;

use App\Models\Factura;
use Livewire\Component;
use Livewire\WithPagination;

class FacturaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $facturas = Factura::where('numero', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.factura.factura-index', compact('facturas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
