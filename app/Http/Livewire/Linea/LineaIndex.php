<?php

namespace App\Http\Livewire\Linea;

use App\Models\Linea;
use Livewire\Component;
use Livewire\WithPagination;

class LineaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $lineas = Linea::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                            ->paginate();
        return view('livewire.linea.linea-index', compact('lineas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
