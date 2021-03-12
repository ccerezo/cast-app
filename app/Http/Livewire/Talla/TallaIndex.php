<?php

namespace App\Http\Livewire\Talla;

use App\Models\Talla;
use Livewire\Component;
use Livewire\WithPagination;

class TallaIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $tallas = Talla::where('numero1', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('numero2', 'LIKE', '%' . $this->search . '%')
                            ->paginate(10);
        return view('livewire.talla.talla-index', compact('tallas'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
