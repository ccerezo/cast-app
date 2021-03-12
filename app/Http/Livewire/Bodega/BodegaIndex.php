<?php

namespace App\Http\Livewire\Bodega;

use App\Models\Bodega;
use Livewire\Component;
use Livewire\WithPagination;

class BodegaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $bodegas = Bodega::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('direccion', 'LIKE', '%' . $this->search . '%')
                            ->paginate();
        return view('livewire.bodega.bodega-index', compact('bodegas'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
