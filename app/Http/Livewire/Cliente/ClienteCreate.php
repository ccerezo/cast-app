<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use App\Models\Cupo;
use App\Models\TipoCliente;
use Livewire\Component;

class ClienteCreate extends Component
{
    public $identificacion;
    public $nombre;
    public $direccion;
    public $telefono;
    public $correo;
    public $tipo_cliente_id;
    public $tipoCliente;
    public $cupo_aprobado;
    public $openModal = false;

    protected $rules = [
        'identificacion' => 'required',
        'nombre' => 'required',
        'cupo_aprobado' => 'numeric|min:1',
    ];

    public function mount()
    {
        $this->tipoCliente = TipoCliente::where('activo', '=', 'si')->first();
        $this->tipo_cliente_id = $this->tipoCliente->id;
    }
    public function getTipoCliente()
    {
        $this->tipoCliente = TipoCliente::find($this->tipo_cliente_id);
        if($this->tipoCliente->codigo != '01')
            $this->cupo_aprobado = 1;
        else
            $this->cupo_aprobado = null;
    }
    public function save() {
        $this->validate();

        $cliente = Cliente::create([
            'identificacion' => $this->identificacion,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'tipo_cliente_id' => $this->tipo_cliente_id
        ]);
        // 01 => es cliente de tpo vendedor
        if($this->tipoCliente->codigo == '01'){
            $cupo = Cupo::create([
                'cupo_aprobado' => $this->cupo_aprobado,
                'cupo_disponible' => $this->cupo_aprobado,
                'saldo' => 0,
                'cliente_id' => $cliente->id
            ]);
        }

        $this->emitTo('cliente.cliente-index','render');
        $this->reset(['identificacion','nombre','direccion','telefono','correo']);
    }
    public function render()
    {
        $tipos = TipoCliente::pluck('tipo','id');
        return view('livewire.cliente.cliente-create', compact('tipos'));
    }
}
