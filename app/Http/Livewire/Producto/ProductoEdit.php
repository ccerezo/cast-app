<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Color;
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
    public $searchColor;
    public $searchCodigoBarras;
    public $condiciones = array();
    public $bandera = false;

    public $produccion;
    public $mayorista;
    public $publico;
    public $stock;
    public $producto;

    public function render()
    {
        $this->condiciones = array();
        $this->bandera = false;
        $productos = array();
        $categorias = Categoria::all();
        $lineas = Linea::all();
        $tallas = Talla::all();
        $modelos = Modelo::all();
        $colors = Color::all();
        //array_push($this->condiciones, ['codigo', 'LIKE', '%' . $this->search . '%']);
        if(isset($this->searchCodigoBarras) && $this->searchCodigoBarras > 0){
            array_push($this->condiciones, ['codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%']);
            $this->bandera = true;
        }


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
        if(isset($this->searchColor) && $this->searchColor > 0){
            array_push($this->condiciones, ['color_id', '=', $this->searchColor]);
            $this->bandera = true;
        }

        if($this->bandera) {
            $productos = Producto::where($this->condiciones)
                            ->paginate(12);
        } else {
            $productos = Producto::where('id', '=', '0')
                            ->paginate(12);
        }

        return view('livewire.producto.producto-edit', compact('productos','categorias','lineas','tallas','modelos','colors'));
    }

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
        // $this->searchLinea = $producto->linea_id;
        // $this->searchCategoria = $producto->categoria_id;
        // $this->searchModelo = $producto->modelo_id;
        $productos = Producto::where($this->condiciones)->get();

        foreach($productos as $producto){

            $this->produccion[$producto->id] = $producto->precio_produccion;
            $this->mayorista[$producto->id] = $producto->precio_mayorista;
            $this->publico[$producto->id] = $producto->precio_venta_publico;
            $this->stock[$producto->id] = '';
        }

    }

    public function update($id) {

        if (!$this->stock[$id]) {
            $this->stock[$id] = 0;
        }

        $record = Producto::find($id);
        $record->update([
            'precio_produccion' => $this->produccion[$id],
            'precio_mayorista' => $this->mayorista[$id],
            'precio_venta_publico' => $this->publico[$id],
            'stock' => ($this->stock[$id] + $record->stock)
        ]);

        $this->stock[$id] = '';
    }

}
