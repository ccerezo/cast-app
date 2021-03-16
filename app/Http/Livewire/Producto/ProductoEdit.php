<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Linea;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\Component;

class ProductoEdit extends Component
{
    public $search;
    public $searchCategoria;
    public $searchLinea;
    public $searchTalla;
    public $searchModelo;
    public $condiciones = array();
    public $bandera = false;

    public $selected_id;
    public $stock = array();

    public function render()
    {
        $this->condiciones = array();
        $this->bandera = false;
        $productos = array();
        $categorias = Categoria::all();
        $lineas = Linea::all();
        $tallas = Talla::all();
        $modelos = Modelo::all();

        //array_push($this->condiciones, ['codigo', 'LIKE', '%' . $this->search . '%']);

        if(isset($this->searchLinea) && $this->searchLinea > 0){
            array_push($this->condiciones, ['linea_id', '=', $this->searchLinea]);
            $this->bandera = true;
        }

        if(isset($this->searchCategoria) && $this->searchCategoria > 0){
            array_push($this->condiciones, ['categoria_id', '=', $this->searchCategoria]);
            $this->bandera = true;
        }

        if(isset($this->searchModelo) && $this->searchModelo > 0){
            array_push($this->condiciones, ['modelo_id', '=', $this->searchModelo]);
            $this->bandera = true;
        }

        if(isset($this->searchTalla) && $this->searchTalla > 0){
            array_push($this->condiciones, ['talla_id', '=', $this->searchTalla]);
            $this->bandera = true;
        }
        if($this->bandera) {
            $productos = Producto::where($this->condiciones)
                            ->paginate(10);
        } else {
            $productos = Producto::where('id', '=', '0')
                            ->paginate(10);
        }

        return view('livewire.producto.producto-edit', compact('productos','categorias','lineas','tallas','modelos'));
    }

    public function update($id) {

        $record = Producto::find($id);
        $record->update([
            'stock' => ($this->stock[$id] + $record->stock)
        ]);
    }

}
