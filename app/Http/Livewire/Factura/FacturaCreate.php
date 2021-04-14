<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\MetodoPago;
use App\Models\Producto;
use App\Models\Vendedor;
use Livewire\Component;

class FacturaCreate extends Component
{
    public $detalle;
    public $seleccionados;
    public $total;
    public $cantidad;
    public $vendedor;
    public $vendedor_id;
    public $numeroFactura;
    public $total_descuento;
    public $subtotal;
    public $iva;
    public $cliente_id;
    public $indice;
    public $mensaje_repetido;
    public $tipo_factura = 'FINAL';
    public $openModal = false;
    public $forma_pago;
    protected $listeners = ['updateDetalle', 'updateDetalleCliente'];

    public function mount()
    {
        $ultimaFactura = Factura::latest()->first();
        $this->vendedor = Vendedor::where('activo', '=', 'si')->first();
        $this->vendedor_id = $this->vendedor->id;
        if($ultimaFactura != null)
            $this->numeroFactura = $ultimaFactura->numero + 1;
        else
            $this->numeroFactura = 1;
        $this->detalle = Producto::where('id', '=', 0)->get();
        $this->seleccionados = array();
        $this->total = $this->subtotal = $this->total_descuento = $this->iva = 0;
        $this->cantidad = array();
    }

    public function updateDetalle($id)
    {
        $repetido = array_search($id, $this->seleccionados);
        if(!(is_int($repetido))){
            array_push($this->seleccionados, $id);
            array_push($this->cantidad, 1);
            $productos = Producto::whereIn('id', $this->seleccionados)->get()->toArray();
            $func = function($producto,$cantidad) {
                $producto['cantidad'] = $cantidad;
                if(strcmp($this->tipo_factura, 'FINAL') === 0){
                    $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'];
                    $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                } else {
                    if(strcmp($this->tipo_factura, 'MAYORISTA') === 0){
                        $producto['importe'] = $producto['precio_mayorista'] * $producto['cantidad'];
                        $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                    }
                }

                return $producto;
            };


            $this->detalle = array_map($func,$productos,$this->cantidad);

            for ($i = 0; $i < count($this->seleccionados); ++$i){
                $this->valorFinal($this->seleccionados[$i], $i);
            }
            $this->valores();
            $this->mensaje_repetido = '';
        }else {
            $this->mensaje_repetido = 'El item ya fue agregado';
        }
        //array_push($this->seleccionados, ['id', '=', $id]);
        //$this->detalle = Producto::whereIn('id', $this->seleccionados)->get()->toArray();

    }
    public function cambiarPrecios()
    {
        if(count($this->detalle) > 0) {
            for ($i = 0; $i < count($this->seleccionados); ++$i){
                $this->valorFinal($this->seleccionados[$i], $i);
            }
            $this->valores();
        }
    }
    public function updateDetalleCliente($id)
    {
        $this->cliente_id = $id;
    }
    public function consultarVendedor()
    {
        $this->vendedor = Vendedor::where('id', '=', $this->vendedor_id)->first();
    }
    public function eliminarProducto($id)
    {
        $this->indice = array_search($id, array_column(($this->detalle),'id'));
        array_splice($this->detalle, $this->indice, 1);
        $indiceSeleccionados = array_search($id, $this->seleccionados);
        array_splice($this->seleccionados, $indiceSeleccionados, 1);
        array_splice($this->cantidad, $indiceSeleccionados, 1);
        $this->valores();
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
                    if(strcmp($this->tipo_factura, 'FINAL') === 0){
                        $producto['importe'] = $producto['precio_venta_publico'] * $this->cantidad[$indice];
                        $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                        $producto['cantidad'] = $this->cantidad[$indice];
                    } else {
                        if(strcmp($this->tipo_factura, 'MAYORISTA') === 0){
                            $producto['importe'] = $producto['precio_mayorista'] * $this->cantidad[$indice];
                            $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                            $producto['cantidad'] = $this->cantidad[$indice];
                        }
                    }
                }
            }
            return $producto;
        };

        $id_array = array_fill(0, count($this->detalle), $id);
        $indice_array = array_fill(0, count($this->detalle), $indice);
        $this->detalle = array_map($cantidadImporte,$this->detalle,$id_array, $indice_array);
        $this->valores();
    }
    public function pagar() {
        $this->openModal = true;
    }
    public function render()
    {
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
        $metodos = MetodoPago::where('activo', '=', 'si')->get();
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        return view('livewire.factura.factura-create', compact('clientes','vendedors','metodos','formaPago'));
    }
}
