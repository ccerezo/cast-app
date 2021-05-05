<?php

namespace App\Http\Livewire\InventarioMateriaPrima;

use App\Models\InventarioMateriaPrima;
use App\Models\MateriaPrimaDetalle;
use Livewire\Component;
use Livewire\WithPagination;

class InventarioMateriaPrimaIndex extends Component
{
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direcction = 'desc';

    public $inventario_tmp;
    public $inventario_salidas = array();
    public $total_salidas;
    public $fecha;
    public $salidas;
    public $openModal = false;

    protected $rules = [
        'fecha' => 'required',
        'salidas' => 'numeric|required',
    ];

    public function render()
    {
        $invetarioMaterias = InventarioMateriaPrima::join('proveedors', 'inventario_materia_primas.proveedor_id', '=', 'proveedors.id')
                            ->join('materia_primas', 'inventario_materia_primas.materia_prima_id', '=', 'materia_primas.id')
                            ->Where('proveedors.nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('proveedors.identificacion', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('materia_primas.codigo', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('materia_primas.descripcion', 'LIKE', '%' . $this->search . '%')
                            ->select('inventario_materia_primas.*')
                            ->orderBy('inventario_materia_primas.id', 'desc')
                            ->paginate(10);

        return view('livewire.inventario-materia-prima.inventario-materia-prima-index', compact('invetarioMaterias'));
    }

    public function registrarSalidas($id) {
        $this->openModal = true;
        $this->inventario_tmp = InventarioMateriaPrima::find($id);
        $this->inventario_salidas = MateriaPrimaDetalle::where('inventario_materia_prima_id', '=', $id)->get();
        $this->total_salidas = MateriaPrimaDetalle::where('inventario_materia_prima_id', '=', $this->inventario_tmp->id)->sum('salidas');
    }

    public function saveDetalle() {
        $this->validate();

        $registro_salida = MateriaPrimaDetalle::create([
            'fecha' => $this->fecha,
            'salidas' => $this->salidas,
            'inventario_materia_prima_id' => $this->inventario_tmp->id
        ]);

        $this->inventario_salidas = MateriaPrimaDetalle::where('inventario_materia_prima_id', '=', $this->inventario_tmp->id)->get();
        $this->total_salidas = MateriaPrimaDetalle::where('inventario_materia_prima_id', '=', $this->inventario_tmp->id)->sum('salidas');

        $this->inventario_tmp->update([
            'stock' => $this->inventario_tmp->stock - $registro_salida->salidas
        ]);

        $this->reset(['fecha','salidas']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
