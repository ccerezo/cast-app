<?php

namespace App\Http\Livewire\PagoFactura;

use App\Models\Cliente;
use App\Models\Cupo;
use App\Models\EstadoFactura;
use App\Models\Factura;
use App\Models\MetodoPago;
use App\Models\pagoFactura;
use Livewire\Component;
use Livewire\WithPagination;

class PagoFacturaIndex extends Component
{
    use WithPagination;
    public $search;
    public $searchNumero;
    public $searchContado;
    public $searchCredito;
    public $openModal = false;
    public $openModalTotal = false;
    public $factura_tmp;
    public $por_cobrar;
    public $abonado;
    public $cliente_id;
    public $cliente;
    public $condiciones = array();
    public $monto;
    public $fecha;
    public $metodo_pago;
    public $descripcion;
    public $pagos_factura = array();
    public $select_factura = array();
    public $facturas_imprimir = array();
    public $total_pagos = 0;
    public $total_facturas_seleccionadas = 0;
    protected $listeners = ['updateDetalleCliente'];

    protected $rules = [
        'monto' => 'required',
        'fecha' => 'required',
        'metodo_pago' => 'required'
    ];

    public function mount()
    {
        $this->por_cobrar = Factura::where('forma_pago', '=', 'CREDITO')
                        ->whereIn('facturas.estado_factura_id', [3, 4])
                        ->sum('total');

        $this->abonado =  pagoFactura::join('facturas', 'pago_facturas.factura_id', '=', 'facturas.id')
                        ->where('facturas.forma_pago', '=', 'CREDITO')
                        ->whereIn('facturas.estado_factura_id', [3, 4])
                        ->sum('pago_facturas.monto');
    }
    public function updateDetalleCliente($id)
    {
        $this->cliente_id = $id;
        $this->cliente = Cliente::find($id);
        $this->por_cobrar =  $this->cobrarCliente();
        $this->abonado =  $this->abonadoTotalCliente();

    }

    public function registrarPago($id) {
        $this->openModal = true;
        $this->factura_tmp = Factura::find($id);
        $this->pagos_factura = pagoFactura::where('factura_id', '=', $id)->get();
        $this->total_pagos = pagoFactura::where('factura_id', '=', $this->factura_tmp->id)->sum('monto');
    }
    public function registrarPagoFacturasSeleccionadas() {
        $this->openModalTotal = true;
        $this->facturas_imprimir = [];
        //$this->factura_tmp = Cliente::find($id);
        // $this->pagos_factura = pagoFactura::where('factura_id', '=', $id)->get();
        // $this->total_pagos = pagoFactura::where('factura_id', '=', $this->factura_tmp->id)->sum('monto');
    }
    public function save() {
        $this->validate();

        $pago = pagoFactura::create([
            'fecha' => $this->fecha,
            'monto' => $this->monto,
            'descripcion' => $this->descripcion,
            'factura_id' => $this->factura_tmp->id,
            'metodo_pago_id' => $this->metodo_pago
        ]);

        $this->pagos_factura = pagoFactura::where('factura_id', '=', $this->factura_tmp->id)->get();
        $this->total_pagos = pagoFactura::where('factura_id', '=', $this->factura_tmp->id)->sum('monto');
        $cupo = Cupo::where('cliente_id', '=', $this->factura_tmp->cliente_id)->first();
        if($cupo) {
            $cupo->update([
                'cupo_disponible' => $cupo->cupo_disponible + $this->monto,
                'saldo' => $cupo->saldo - $this->monto,
            ]);
        }

        if($this->total_pagos >= $this->factura_tmp->total){
            $estado_factura = EstadoFactura::where('codigo', '=', '01')->first();
            $this->factura_tmp->update([
                'estado_factura_id' => $estado_factura->id
            ]);
        } else {
            $estado_factura = EstadoFactura::where('codigo', '=', '04')->first();
            $this->factura_tmp->update([
                'estado_factura_id' => $estado_factura->id
            ]);
        }

        $this->factura_tmp = Factura::find($this->factura_tmp->id);
        $this->por_cobrar =  $this->cobrarCliente();
        $this->abonado = $this->abonadoTotalCliente();
        $this->reset(['fecha','monto','descripcion','metodo_pago']);
    }
    public function saveFacturasSeleccionadas() {

        $this->validate();

        if(count($this->select_factura) > 0){
            $this->total_facturas_seleccionadas = 0;
            foreach($this->select_factura as $key => $sel_fact){
                if ($sel_fact) {
                    array_push($this->facturas_imprimir,$key);
                    $record = Factura::find($key);
                    $saldo = $record->total - $this->abonadoPorFactura($record->id);
                    $pago = pagoFactura::create([
                        'fecha' => $this->fecha,
                        'monto' => $saldo,
                        'descripcion' => 'Pago de $'.$saldo. ' del monto abono de: $'. $this->monto.' - '.$this->descripcion,
                        'factura_id' => $record->id,
                        'metodo_pago_id' => $this->metodo_pago
                    ]);

                    $cupo = Cupo::where('cliente_id', '=', $record->cliente_id)->first();
                    if($cupo) {
                        $cupo->update([
                            'cupo_disponible' => $cupo->cupo_disponible + $saldo,
                            'saldo' => 0,
                        ]);
                    }
                    $estado_factura = EstadoFactura::where('codigo', '=', '01')->first();
                    $record->update([
                        'estado_factura_id' => $estado_factura->id
                    ]);
                }
            }
            $pago->monto = $this->monto;
            $pago->descripcion = $this->descripcion;
            session()->flash('messagePago', $pago);
        }

        $this->por_cobrar =  $this->cobrarCliente();
        $this->abonado = $this->abonadoTotalCliente();
        $this->reset(['fecha','monto','descripcion','metodo_pago','select_factura']);
    }
    public function render()
    {
        $this->condiciones = array();
        $clientes = Cliente::pluck('nombre','id');

        $metodos = MetodoPago::where('activo', '=', 'si')->get();
        $formaPago = ['contado' => 'CONTADO', 'credito' => 'CRÉDITO'];
        if(isset($this->searchNumero) && $this->searchNumero > 0){
            array_push($this->condiciones, ['facturas.numero', '=', $this->searchNumero]);
        }
        if(!($this->searchContado == 'CONTADO' && $this->searchCredito == 'CREDITO')){
            if(isset($this->searchContado) && $this->searchContado == 'CONTADO'){
                array_push($this->condiciones, ['facturas.forma_pago', '=', $this->searchContado]);
            }
            if(isset($this->searchCredito) && $this->searchCredito == 'CREDITO'){
                array_push($this->condiciones, ['facturas.forma_pago', '=', $this->searchCredito]);
            }
        }
        if(isset($this->cliente_id) && $this->cliente_id > 0){
            array_push($this->condiciones, ['facturas.cliente_id', '=', $this->cliente_id]);
        }

        $facturas = Factura::join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                        ->where($this->condiciones)
                        ->where('estado_factura_id', '<>', 2)
                        ->select('facturas.*')
                        ->orderBy('facturas.id', 'desc')
                        ->paginate(10);


        return view('livewire.pago-factura.pago-factura-index', compact('facturas','clientes','metodos','formaPago'));
    }

    public function cobrarCliente() {

        return Factura::join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                    ->where('facturas.cliente_id', '=', $this->cliente_id)
                    ->where('facturas.forma_pago', '=', 'CREDITO')
                    ->whereIn('facturas.estado_factura_id', [3, 4])
                    ->sum('facturas.total');
    }

    public function abonadoTotalCliente() {

        return pagoFactura::join('facturas', 'pago_facturas.factura_id', '=', 'facturas.id')
                        ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                        ->where('clientes.id', '=', $this->cliente_id)
                        ->where('facturas.forma_pago', '=', 'CREDITO')
                        ->whereIn('facturas.estado_factura_id', [3, 4])
                        ->sum('pago_facturas.monto');
    }
    public function abonadoPorFactura($factura_id) {

        return pagoFactura::join('facturas', 'pago_facturas.factura_id', '=', 'facturas.id')
                        ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                        ->where('facturas.id', '=', $factura_id)
                        ->sum('pago_facturas.monto');
    }
    public function facturasSeleccionadas() {
        if(count($this->select_factura) > 0){
            $this->total_facturas_seleccionadas = 0;
            foreach($this->select_factura as $key => $sel_fact){
                if ($sel_fact) {
                    $record = Factura::find($key);
                    $this->total_facturas_seleccionadas = $this->total_facturas_seleccionadas + ($record->total - $this->abonadoPorFactura($key));
                    // $record->update([
                    //     'stock' => ($entrada + $record->stock)
                    // ]);

                } else {
                    unset($this->select_factura[$key]);
                }
                //$this->entrada_individual = $entrada.'-'.$key;
            }
            //session()->flash('message', 'Post successfully updated.');
        }
        //$this->reset(['entradas','ingresar_entradas','openGuardarEntradas']);
    }
    public function updatingSearchNumero()
    {
        $this->resetPage();
    }
}
