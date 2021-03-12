<?php

namespace App\Http\Livewire\Modelo;

use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;

class ModeloIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $modelos = Modelo::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                            ->paginate();
        return view('livewire.modelo.modelo-index', compact('modelos'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
