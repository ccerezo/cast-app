<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $categorias = Categoria::where('nombre', 'LIKE', '%' . $this->search . '%')
                                ->paginate();
        return view('livewire.categoria.categoria-index', compact('categorias'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
