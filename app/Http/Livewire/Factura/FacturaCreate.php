<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Vendedor;
use Livewire\Component;

class FacturaCreate extends Component
{
    public $detalle;
    public $seleccionados;
    public $total;
    public $cantidad;
    public $numeroFactura;
    public $total_descuento;
    public $subtotal;
    public $iva;
    public $cliente_id;
    protected $listeners = ['updateDetalle', 'updateDetalleCliente'];

    public function mount()
    {
        $ultimaFactura = Factura::latest()->first();
        if($ultimaFactura != null)
            $this->numeroFactura = $ultimaFactura->numero + 1;
        else
            $this->numeroFactura = 1;
        $this->detalle = Producto::where('id', '=', 0)->get();
        $this->seleccionados = array();
        $this->total = $this->subtotal = $this->total_descuento = $this->iva = $this->cliente_id = 0;
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
            $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'];
            $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
            return $producto;
        };
        array_push($this->cantidad, 1);

        $this->detalle = array_map($func,$productos,$this->cantidad);

        for ($i = 0; $i < count($this->seleccionados); ++$i){
            $this->valorFinal($this->seleccionados[$i], $i);
        }
        $this->valores();

    }
    public function updateDetalleCliente($id)
    {
        $this->cliente_id = $id;
    }
    public function valores()
    {
        $this->subtotal = array_sum(array_column(($this->detalle),'importe'));
        $this->total_descuento = array_sum(array_column(($this->detalle),'valor_descuento'));
        $this->total = $this->subtotal - $this->total_descuento;

    }
    public function valorFinal($id,$indice)
    {
        $cantidadImporte = function($producto,$id,$indice) {
            if($id == $producto['id']) {
                if($this->cantidad[$indice]){
                    $producto['importe'] = $producto['precio_venta_publico'] * $this->cantidad[$indice];
                    $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                    $producto['cantidad'] = $this->cantidad[$indice];
                }
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
