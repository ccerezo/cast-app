<?php

namespace App\Http\Livewire\PagoFactura;

use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Factura;
use App\Models\MetodoPago;
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
    public $vendedor;
    public $vendedor_id;
    public $cliente_id;
    public $condiciones = array();
    protected $listeners = ['updateDetalleCliente'];

    public function mount()
    {
        $this->vendedor = Vendedor::where('activo', '=', 'si')->first();
        $this->vendedor_id = $this->vendedor->id;
    }
    public function consultarVendedor()
    {
        $this->vendedor = Vendedor::where('id', '=', $this->vendedor_id)->first();
    }
    public function updateDetalleCliente($id)
    {
        $this->cliente_id = $id;
    }
    public function render()
    {
        $this->condiciones = array();
        $clientes = Cliente::pluck('nombre','id');
        $vendedors = Vendedor::pluck('nombre','id');
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
                        ->paginate(10);


        return view('livewire.pago-factura.pago-factura-index', compact('facturas','clientes','vendedors','metodos','formaPago'));
    }
    public function updatingSearchNumero()
    {
        $this->resetPage();
    }
}
