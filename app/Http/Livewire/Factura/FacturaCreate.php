<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Vendedor;
use Livewire\Component;

class FacturaCreate extends Component
{
    public $detalle;
    public $seleccionados;
    public $total;
    public $items_cantidad;
    protected $listeners = ['updateDetalle'];

    public function mount()
    {
        $this->detalle = Producto::where('id', '=', 0)->get();
        $this->seleccionados = array();
        $this->total = 0;
        $this->items_cantidad = 1;
    }
    public function updateDetalle($id)
    {
        array_push($this->seleccionados, $id);
        //array_push($this->seleccionados, ['id', '=', $id]);
        $this->detalle = Producto::whereIn('id', $this->seleccionados)->get();
        $this->valores();
    }
    public function valores()
    {
        $tmp_total = 0;
        foreach($this->detalle as $item){
            $tmp_total = $tmp_total + $item->precio_venta_publico;
        }
        $this->total = $tmp_total;
    }
    public function valorFinal()
    {
        $this->items_cantidad = 5;
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
