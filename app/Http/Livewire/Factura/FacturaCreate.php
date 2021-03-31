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
    public $cantidad;
    protected $listeners = ['updateDetalle'];

    public function mount()
    {
        $this->detalle = Producto::where('id', '=', 0)->get();
        $this->seleccionados = array();
        $this->total = 0;
        $this->cantidad = array();
    }
    public function updateDetalle($id)
    {
        array_push($this->seleccionados, $id);
        //array_push($this->seleccionados, ['id', '=', $id]);
        //$this->detalle = Producto::whereIn('id', $this->seleccionados)->get()->toArray();
        $productos = Producto::whereIn('id', $this->seleccionados)->get()->toArray();
        $func = function($producto,$cantidad) {

            $producto['cantidad'] = $cantidad;
            $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'] ;
            return $producto;
        };
        array_push($this->cantidad, 1);

        $this->detalle = array_map($func,$productos,$this->cantidad);

        $this->valores();
        for ($i = 0; $i < count($this->seleccionados); ++$i){
            $this->valorFinal($this->seleccionados[$i], $i);
        }

    }
    public function valores()
    {
        // $tmp_total = 0;
        // foreach($this->detalle as $item){
        //     $tmp_total = $tmp_total + $item->precio_venta_publico;
        // }

        $this->total = array_sum(array_column(($this->detalle),'importe')); //$tmp_total;
    }
    public function valorFinal($id,$indice)
    {
        $cantidadImporte = function($producto,$id,$indice) {
            if($id == $producto['id']) {
                $producto['importe'] = $producto['precio_venta_publico'] * $this->cantidad[$indice];
                $producto['cantidad'] = $this->cantidad[$indice];
            }
            return $producto;
        };

        $id_array = array_fill(0, count($this->detalle), $id);
        $indice_array = array_fill(0, count($this->detalle), $indice);
        $this->detalle = array_map($cantidadImporte,$this->detalle,$id_array, $indice_array);
        $this->valores();
    }

    public function render()
    {
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        return view('livewire.factura.factura-create', compact('clientes','vendedors','formaPago'));
    }
}
