<?php

namespace App\Http\Livewire\Shared;

use App\Models\Producto;
use Livewire\Component;

class ProductoSearch extends Component
{
    public $query;
    public $productos;
    public $productosSeleccionados;
    public $highlightIndex;

    public function mount()
    {
        $this->resetear();
    }

    public function resetear()
    {
        $this->query = '';
        $this->productos = [];
        $this->productosSeleccionados = array();
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
            //$this->redirect(route('show-contact', $producto['id']));
            $this->query = $producto['descripcion'];
            //array_push($this->productosSeleccionados,$producto);
            $this->emit('updateDetalle',  $producto['id']);
            $this->resetear();
        }
    }

    public function selectProductoClick($i)
    {
        $this->highlightIndex = $i;
        $producto = $this->productos[$this->highlightIndex] ?? null;
        if ($producto) {
            //$this->redirect(route('show-contact', $producto['id']));
            $this->query = $producto['descripcion'];
            //array_push($this->productosSeleccionados,$producto);
            $this->emit('updateDetalle',  $producto['id']);
            $this->resetear();
        }
    }

    public function updatedQuery()
    {
        $this->productos = Producto::where('descripcion', 'like', '%' . $this->query . '%')
                                    ->orWhere(function ($query) {
                                        $query->where('codigo_barras', 'LIKE', '%' . $this->query . '%')
                                            ->orWhere('codigo', 'LIKE', '%' . $this->query . '%');
                                    })
                                    ->get()
                                    ->toArray();
    }

    public function render()
    {
        return view('livewire.shared.producto-search');
    }
}
