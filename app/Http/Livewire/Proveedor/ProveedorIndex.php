<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class ProveedorIndex extends Component
{
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direcction = 'desc';

    public function render()
    {
        $proveedors = Proveedor::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('identificacion', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate(10);
        return view('livewire.proveedor.proveedor-index', compact('proveedors'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
