<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Vendedor;
use Livewire\Component;
use Livewire\WithPagination;

class VendedorIndex extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $vendedors = Vendedor::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('identificacion', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.vendedor.vendedor-index', compact('vendedors'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
