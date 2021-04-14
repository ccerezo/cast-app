<?php

namespace App\Http\Livewire\Factura;

use App\Models\Factura;
use Livewire\Component;
use Livewire\WithPagination;

class FacturaIndex extends Component
{
    use WithPagination;
    public $search;
    public $openModal = false;
    public $factura_tmp;

    public function modalEliminar($id) {
        $this->openModal = true;
        $this->factura_tmp = Factura::find($id);
    }
    public function render()
    {
        // $facturas = Factura::where('numero', 'LIKE', '%' . $this->search . '%')
        //                     ->paginate(10);
        $facturas = Factura::join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                            ->where('facturas.numero', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('clientes.nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('clientes.identificacion', 'LIKE', '%' . $this->search . '%')
                            ->select('facturas.*')
                            ->orderBy('facturas.id', 'desc')
                            ->paginate(10);
        return view('livewire.factura.factura-index', compact('facturas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
