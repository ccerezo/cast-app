<?php

namespace App\Http\Livewire\Shared;

use App\Models\Producto;
use Livewire\Component;

class ProductoSearch extends Component
{
    public $query;
    public $productos;
    public $highlightIndex;

    public function mount()
    {
        $this->resetear();
    }

    public function resetear()
    {
        $this->query = '';
        $this->productos = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->productos) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->productos) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectProducto()
    {
        $producto = $this->productos[$this->highlightIndex] ?? null;
        if ($producto) {
            $this->redirect(route('show-contact', $producto['id']));
        }
    }

    public function updatedQuery()
    {
        $this->productos = Producto::where('descripcion', 'like', '%' . $this->query . '%')
            ->orWhere('codigo_barras', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.shared.producto-search');
    }
}
