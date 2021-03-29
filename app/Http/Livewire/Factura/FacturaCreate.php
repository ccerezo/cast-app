<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Vendedor;
use Livewire\Component;

class FacturaCreate extends Component
{
    public function render()
    {
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        return view('livewire.factura.factura-create', compact('clientes','vendedors','formaPago'));
    }
}
