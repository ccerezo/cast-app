<?php

namespace App\Http\Livewire\Factura;

use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Producto;
use App\Models\pagoFactura;
use App\Models\TipoCliente;
use Livewire\Component;

class FacturaEdit extends Component
{
    public $factura;
    public $detalle;
    public $pagos;
    public $tiposCliente;
    public $seleccionados= array();
    public $mensaje_repetido;
    public $cantidad = array();
    public $subtotal;
    public $iva;
    public $total_descuento;
    public $total;
    public $cantidad_total;
    public $cantidad_total_tmp;

    protected $listeners = ['updateDetalle'];

    public function mount(Factura $factura) {
        $this->factura = $factura;
        $this->subtotal = $this->factura->subtotal;
        $this->iva = $this->factura->iva;
        $this->total = $this->factura->total;
        $this->total_descuento = $this->factura->total_descuento;

        $productos = Producto::Join('factura_detalles','productos.id','=','factura_detalles.producto_id')
                                    ->where('factura_detalles.factura_id', '=', $this->factura->id)
                                    ->selectRaw('productos.*, factura_detalles.cantidad as cantidad')
                                    ->get()->toArray();

        $this->pagos = pagoFactura::where('factura_id', '=', $factura->id)->get();
        $this->tiposCliente = TipoCliente::where('activo', '=', 'si')->get();
        //$this->seleccionados = FacturaDetalle::where('factura_id', '=', $this->factura->id)->get();

        $func = function($producto) {
            array_push($this->seleccionados, $producto['id']);
            array_push($this->cantidad, $producto['cantidad']);
            if(strcmp($this->factura->tipoCliente->codigo, '01') === 0){
                $producto['importe'] = $producto['precio_produccion'] * $producto['cantidad'];
                $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
            } else {
                if(strcmp($this->factura->tipoCliente->codigo, '02') === 0){
                    $producto['importe'] = $producto['precio_mayorista'] * $producto['cantidad'];
                    $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                } else {
                    if(strcmp($this->factura->tipoCliente->codigo, '03') === 0){
                        $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'];
                        $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                    }
                }
            }

            return $producto;
        };

        $this->detalle = array_map($func,$productos);
        $this->cantidad_total = array_sum($this->cantidad);
        $this->cantidad_total_tmp = array_sum($this->cantidad);
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
                if(strcmp($this->factura->tipoCliente->codigo, '01') === 0){
                    $producto['importe'] = $producto['precio_produccion'] * $producto['cantidad'];
                    $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                } else {
                    if(strcmp($this->factura->tipoCliente->codigo, '02') === 0){
                        $producto['importe'] = $producto['precio_mayorista'] * $producto['cantidad'];
                        $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                    } else {
                        if(strcmp($this->factura->tipoCliente->codigo, '03') === 0){
                            $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'];
                            $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                        }
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

    }
    public function valores()
    {
        $this->subtotal = array_sum(array_column(($this->detalle),'importe'));
        $this->total_descuento = array_sum(array_column(($this->detalle),'valor_descuento'));
        $this->total = $this->subtotal - $this->total_descuento;
        $this->cantidad_total = array_sum($this->cantidad);

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
    public function valorFinal($id,$indice)
    {
        $cantidadImporte = function($producto,$id,$indice,$codigo) {
            if($id == $producto['id']) {
                if($this->cantidad[$indice]){
                    if(strcmp($codigo, '01') === 0){
                        $producto['importe'] = $producto['precio_produccion'] * $this->cantidad[$indice];
                        $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                        $producto['cantidad'] = $this->cantidad[$indice];
                    } else {
                        if(strcmp($codigo, '02') === 0){
                            $producto['importe'] = $producto['precio_mayorista'] * $this->cantidad[$indice];
                            $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                            $producto['cantidad'] = $this->cantidad[$indice];
                        } else {
                            if(strcmp($codigo, '03') === 0){ //FINAL
                                $producto['importe'] = $producto['precio_venta_publico'] * $this->cantidad[$indice];
                                $producto['valor_descuento'] = $producto['importe'] * ($producto['descuento']/100);
                                $producto['cantidad'] = $this->cantidad[$indice];
                            }
                        }
                    }
                }
            }
            return $producto;
        };

        $id_array = array_fill(0, count($this->detalle), $id);
        $indice_array = array_fill(0, count($this->detalle), $indice);
        $codigo_array = array_fill(0, count($this->detalle), $this->factura->tipoCliente->codigo);
        $this->detalle = array_map($cantidadImporte,$this->detalle,$id_array, $indice_array,$codigo_array);
        $this->valores();
    }

    public function render()
    {
        return view('livewire.factura.factura-edit');
    }
}
