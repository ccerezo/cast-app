<?php

namespace App\Http\Livewire\MateriaPrima;

use App\Models\MateriaPrima;
use Livewire\Component;
use Livewire\WithPagination;

class MateriaPrimaIndex extends Component
{
    use WithPagination;
    public $search;
    public $sort = 'id';
    public $direcction = 'desc';

    public function render()
    {
        $materiasPrimas = MateriaPrima::where('codigo', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate(10);
        return view('livewire.materia-prima.materia-prima-index', compact('materiasPrimas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
