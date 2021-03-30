<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Vendedor;
use Livewire\Component;

class FacturaCreate extends Component
{
    public $detalle;
    public $seleccionados = [];
    protected $listeners = ['updateDetalle'];

    public function mount()
    {
        //$this->detalle = Producto::where('id', '=', 1)->get();
        $this->seleccionados = Producto::where('id', '=', 0)->get();
        //$this->updateDetalle(20);
    }
    public function updateDetalle($id)
    {
        //sleep(5);
        $this->detalle = Producto::where('id', '=', $id)->get();
        if(count($this->seleccionados) > 0)
            array_push($this->seleccionados, $this->detalle);
        else
            $this->seleccionados = $this->detalle;
        //$this->detalle = Producto::find($id);
        //array_push($this->seleccionados, '1');
    }
    public function render()
    {
        //$productos = Producto::pluck('descripcion',$productos['id']);
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        return view('livewire.factura.factura-create', compact('clientes','vendedors','formaPago'));
    }
}
