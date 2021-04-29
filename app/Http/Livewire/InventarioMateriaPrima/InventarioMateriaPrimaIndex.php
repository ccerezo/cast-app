<?php

namespace App\Http\Livewire\InventarioMateriaPrima;

use App\Models\InventarioMateriaPrima;
use Livewire\Component;
use Livewire\WithPagination;

class InventarioMateriaPrimaIndex extends Component
{
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direcction = 'desc';

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
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
