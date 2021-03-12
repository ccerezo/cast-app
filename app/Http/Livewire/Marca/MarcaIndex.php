<?php

namespace App\Http\Livewire\Marca;

use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class MarcaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $marcas = Marca::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                            ->paginate();
        return view('livewire.marca.marca-index', compact('marcas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
