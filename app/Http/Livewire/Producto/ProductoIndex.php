<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Linea;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\Component;
use Livewire\WithPagination;

class ProductoIndex extends Component
{
    use WithPagination;
    public $search;
    public $searchCategoria;
    public $searchLinea;
    public $searchTalla;
    public $searchModelo;
    public $searchCodigoBarras;
    public $condiciones = array();
    public $productoTMP;

    public function render()
    {
        $this->condiciones = array();
        $categorias = Categoria::all();
        $lineas = Linea::all();
        $tallas = Talla::all();
        $modelos = Modelo::all();
        $producto_tmp = Producto::pluck('id')->first();
        $this->productoTMP = Producto::where('id', '=', 1)->first();
        array_push($this->condiciones, ['codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%']);

        if(isset($this->searchLinea) && $this->searchLinea > 0){
            array_push($this->condiciones, ['linea_id', '=', $this->searchLinea]);
        }

        if(isset($this->searchCategoria) && $this->searchCategoria > 0){
            array_push($this->condiciones, ['categoria_id', '=', $this->searchCategoria]);
        }

        if(isset($this->searchModelo) && $this->searchModelo > 0){
            array_push($this->condiciones, ['modelo_id', '=', $this->searchModelo]);
        }

        if(isset($this->searchTalla) && $this->searchTalla > 0){
            array_push($this->condiciones, ['talla_id', '=', $this->searchTalla]);
        }

        $productos = Producto::where($this->condiciones)
                            ->paginate(12);

        return view('livewire.producto.producto-index',
                    compact('productos','categorias','lineas','tallas','modelos','producto_tmp'));
    }

    public function generateCodeBar($id) {
        $this->productoTMP = Producto::where('id', '=', $id)->first();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingSearchCategoria()
    {
        $this->resetPage();
    }
    public function updatingSearchLinea()
    {
        $this->resetPage();
    }
    public function updatingSearchTalla()
    {
        $this->resetPage();
    }
    public function updatingSearchModelo()
    {
        $this->resetPage();
    }
}
