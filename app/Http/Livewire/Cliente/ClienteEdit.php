<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use App\Models\Cupo;
use App\Models\TipoCliente;
use Livewire\Component;

class ClienteEdit extends Component
{
    public $openModal = false;
    public $cliente;
    public $tipoCliente;
    public $cupo;
    public $cupo_aprobado;

    protected $rules = [
        'cliente.identificacion' => 'required',
        'cliente.nombre' => 'required',
        'cliente.direccion' => '',
        'cliente.telefono' => '',
        'cliente.correo' => '',
        'cliente.tipo_cliente_id' => '',
        'cupo_aprobado' => 'required',
    ];

    public function mount(Cliente $cliente) {
        $this->cliente = $cliente;
        $this->tipoCliente = TipoCliente::find($this->cliente->tipo_cliente_id);
        $this->cupo = Cupo::where('cliente_id', '=', $this->cliente->id)->first();
        if($this->cupo)
            $this->cupo_aprobado = $this->cupo->cupo_aprobado;
        else{
            if($this->tipoCliente->codigo != '01')
                $this->cupo_aprobado = 1;
        }
    }
    public function getTipoCliente()
    {
        $this->tipoCliente = TipoCliente::find($this->cliente->tipo_cliente_id);
        if($this->cupo)
            $this->cupo_aprobado = $this->cupo->cupo_aprobado;
        else{
            if($this->tipoCliente->codigo != '01')
                $this->cupo_aprobado = 1;
            else
                $this->cupo_aprobado = null;
        }


    }
    public function save() {
        $this->validate();

        $this->cliente->save();

        if($this->cupo){
            // 01 => es cliente de tpo vendedor
            if($this->tipoCliente->codigo == '01'){
                $this->cupo->update([
                    'cupo_aprobado' => $this->cupo_aprobado,
                    'cupo_disponible' => $this->cupo_aprobado,
                    'saldo' => 0
                ]);
            }
        } else {
            if($this->tipoCliente->codigo == '01'){
                $cupo = Cupo::create([
                    'cupo_aprobado' => $this->cupo_aprobado,
                    'cupo_disponible' => $this->cupo_aprobado,
                    'saldo' => 0,
                    'cliente_id' => $this->cliente->id
                ]);
            }
        }

        $this->reset(['openModal']);

        $this->emitTo('cliente.cliente-index','render');
    }
    public function render()
    {
        $tipos = TipoCliente::pluck('tipo','id');
        return view('livewire.cliente.cliente-edit', compact('tipos'));
    }
}
