<?php

namespace App\Http\Livewire\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class ColorIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $colors = Color::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                            ->paginate();
        return view('livewire.color.color-index', compact('colors'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
