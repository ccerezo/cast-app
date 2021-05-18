<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Inventario;
use App\Models\Linea;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\Component;
use Livewire\WithPagination;

class ProductoEdit extends Component
{
    use WithPagination;
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
    public $descuento;
    public $stock;
    public $producto;
    public $created;

    public function render()
    {
        $this->condiciones = array();
        $this->bandera = false;
        $productos = array();
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        $lineas = Linea::orderBy('nombre', 'asc')->get();
        $tallas = Talla::all();
        $modelos = Modelo::orderBy('nombre', 'asc')->get();
        $colors = Color::orderBy('nombre', 'asc')->get();
        //array_push($this->condiciones, ['codigo', 'LIKE', '%' . $this->search . '%']);
        if(isset($this->searchCodigoBarras) && $this->searchCodigoBarras > 0){
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
            $this->created = false;
            $productos = Producto::where($this->condiciones)
                                    ->where(function ($query) {
                                        $query->where('codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                                            ->orWhere('codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                                    })
                                    ->paginate(12);
        } else {
            if($this->created){
                $productos = Producto::where('created_at', '>=', $this->created)
                                        ->where(function ($query) {
                                            $query->where('codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                                                ->orWhere('codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                                        })
                                        ->paginate(12);
            } else {
                $productos = Producto::where('activo', '>=', 'si')
                                        ->where(function ($query) {
                                            $query->where('codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                                                ->orWhere('codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                                        })
                                        ->paginate(12);
            }
        }

        return view('livewire.producto.producto-edit', compact('productos','categorias','lineas','tallas','modelos','colors'));
    }

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
        // $this->searchLinea = $producto->linea_id;
        // $this->searchCategoria = $producto->categoria_id;
        // $this->searchModelo = $producto->modelo_id;
        $this->created = $producto->created_at;
        $productos = Producto::where($this->condiciones)->get();

        foreach($productos as $producto){

            $this->produccion[$producto->id] = $producto->precio_produccion;
            $this->mayorista[$producto->id] = $producto->precio_mayorista;
            $this->publico[$producto->id] = $producto->precio_venta_publico;
            $this->descuento[$producto->id] = $producto->descuento;
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
            'descuento' => $this->descuento[$id],
            'stock' => ($this->stock[$id] + $record->stock)
        ]);
        $inventario = Inventario::where('producto_id', '=', $record->id)->first();
        $inventario->update([
            'entradas' => $inventario->entradas + $this->stock[$id],
            'stock' => $record->stock,
            'ultima_entrada' => date("Y-m-d H:i:s")
        ]);

        $this->stock[$id] = '';
    }

}
