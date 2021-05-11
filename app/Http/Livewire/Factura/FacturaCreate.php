<?php

namespace App\Http\Livewire\Factura;

use App\Models\Cliente;
use App\Models\Cupo;
use App\Models\Factura;
use App\Models\MetodoPago;
use App\Models\Producto;
use App\Models\TipoCliente;
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
    public $facturado_como_id;
    public $indice;
    public $mensaje_repetido;
    public $tipo_factura = '03'; // PRECIO VENTA PUBLICO
    public $openModal = false;
    public $forma_pago;
    public $cupo;
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
                if(strcmp($this->tipo_factura, '01') === 0){
                    $producto['importe'] = $producto['precio_produccion'] * $producto['cantidad'];
                    $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                } else {
                    if(strcmp($this->tipo_factura, '02') === 0){
                        $producto['importe'] = $producto['precio_mayorista'] * $producto['cantidad'];
                        $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                    } else {
                        if(strcmp($this->tipo_factura, '03') === 0){
                            $producto['importe'] = $producto['precio_venta_publico'] * $producto['cantidad'];
                            $producto['valor_descuento'] = $producto['importe']*($producto['descuento']/100);
                        }
                    }
                }
                if(strcmp($producto['iva'], 'si') === 0){
                    $producto['descripcion'] = '(I) '.$producto['descripcion'];
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
    public function cambiarPrecios($tipoClienteId)
    {
        $tipoCliente = TipoCliente::find($tipoClienteId);
        $this->tipo_factura = $tipoCliente->codigo;
        $this->facturado_como_id = $tipoCliente->id;
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
        $cliente = Cliente::find($this->cliente_id);
        $this->facturado_como_id = $cliente->tipo_cliente_id;
        $this->tipo_factura = $cliente->tipoCliente->codigo;
        if(strcmp($this->tipo_factura, '01') === 0){
            $this->cupo = Cupo::where('cliente_id', '=', $this->cliente_id)->first();
        } else {
            $this->cupo = null;
        }
        if(count($this->detalle) > 0) {
            for ($i = 0; $i < count($this->seleccionados); ++$i){
                $this->valorFinal($this->seleccionados[$i], $i);
            }
            $this->valores();
        }
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
        $this->iva = array_sum(array_column(($this->detalle),'valor_iva'));
        $this->total = ($this->subtotal + $this->iva) - $this->total_descuento;

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
                    if(strcmp($producto['iva'], 'si') === 0){
                        $producto['valor_iva'] = ($producto['importe'] * 1.12) - $producto['importe'];
                    } else {
                        $producto['valor_iva'] = 0;
                    }
                }

            }
            return $producto;
        };

        $id_array = array_fill(0, count($this->detalle), $id);
        $indice_array = array_fill(0, count($this->detalle), $indice);
        $codigo_array = array_fill(0, count($this->detalle), $this->tipo_factura);
        $this->detalle = array_map($cantidadImporte,$this->detalle,$id_array, $indice_array,$codigo_array);
        $this->valores();
    }
    public function pagar() {
        $this->openModal = true;
    }
    public function render()
    {
        $clientes = Cliente::pluck('nombre','id');
        $tiposCliente = TipoCliente::where('activo', '=', 'si')->get();
        $metodos = MetodoPago::where('activo', '=', 'si')->get();
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        return view('livewire.factura.factura-create', compact('clientes','tiposCliente','metodos','formaPago'));
    }
}
