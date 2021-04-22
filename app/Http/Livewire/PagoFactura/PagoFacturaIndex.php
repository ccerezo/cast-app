<?php

namespace App\Http\Livewire\PagoFactura;

use App\Models\Cliente;
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
    public $factura_tmp;
    public $vendedor;
    public $vendedor_id;
    public $cliente_id;
    public $condiciones = array();
    public $monto;
    public $fecha;
    public $metodo_pago;
    public $descripcion;
    public $pagos_factura = array();
    public $total_pagos = 0;
    protected $listeners = ['updateDetalleCliente'];

    protected $rules = [
        'monto' => 'required',
        'fecha' => 'required',
        'metodo_pago' => 'required'
    ];

    public function mount()
    {

        $this->vendedor_id = $this->vendedor->id;
    }
    public function consultarVendedor()
    {

    }
    public function updateDetalleCliente($id)
    {
        $this->cliente_id = $id;
    }
    public function registrarPago($id) {
        $this->openModal = true;
        $this->factura_tmp = Factura::find($id);
        $this->pagos_factura = pagoFactura::where('factura_id', '=', $id)->get();
        $this->total_pagos = pagoFactura::where('factura_id', '=', $this->factura_tmp->id)->sum('monto');
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
        $cupoDisponible = $this->vendedor->cupo_disponible + $pago->monto;
        $this->vendedor->update([
            'cupo_disponible' => $cupoDisponible
        ]);

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
        $this->reset(['fecha','monto','descripcion','metodo_pago']);
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
        if(isset($this->vendedor_id) && $this->vendedor_id > 0){
            array_push($this->condiciones, ['facturas.vendedor_id', '=', $this->vendedor_id]);
        }

        $facturas = Factura::join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                        ->where($this->condiciones)
                        ->select('facturas.*')
                        ->orderBy('facturas.id', 'desc')
                        ->paginate(10);


        return view('livewire.pago-factura.pago-factura-index', compact('facturas','clientes','metodos','formaPago'));
    }
    public function updatingSearchNumero()
    {
        $this->resetPage();
    }
}
