<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Color;
use App\Models\Inventario;
use App\Models\InventarioDetalle;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\Component;
use Livewire\WithPagination;

class InventarioIndex extends Component
{
    use WithPagination;
    public $searchCodigoBarras;
    public $searchTalla;
    public $searchColor;
    public $condiciones1;
    public $condiciones2;
    public $condiciones3;
    public $entradas;
    public $entrada_individual;
    public $bandera;

    public function render()
    {
        $this->bandera = false;
        $this->condiciones1 = array();
        $this->condiciones2 = array();
        $this->condiciones3 = array();

        $colors = Color::all();
        $tallas = Talla::all();

        if(isset($this->searchCodigoBarras)){
            array_push($this->condiciones1, ['productos.codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%']);
            array_push($this->condiciones2, ['productos.codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%']);
            $this->bandera = true;
        }

        if(isset($this->searchTalla) && $this->searchTalla > 0){
            array_push($this->condiciones3, ['productos.talla_id', '=', $this->searchTalla]);
        }

        if(isset($this->searchColor) && $this->searchColor > 0){
            array_push($this->condiciones3, ['productos.color_id', '=', $this->searchColor]);
        }
        if($this->bandera){
            $inventarios = Inventario::whereIn('producto_id', function ($query) {
                $query->select('id')
                    ->from('productos')
                    ->where($this->condiciones3)
                    ->where(function($query) {
                        $query->where('productos.codigo_barras', 'LIKE', '%' . $this->searchCodigoBarras . '%')
                              ->orWhere('productos.codigo', 'LIKE', '%' . $this->searchCodigoBarras . '%');
                    })->get();
                })
                ->paginate(10);
        } else {
            $inventarios = Inventario::whereIn('producto_id', function ($query) {
                $query->select('id')
                    ->from('productos')
                    ->where($this->condiciones3)
                    ->orderByDesc('productos.id');
                })
                ->paginate(10);
        }

        return view('livewire.inventario.inventario-index', compact('inventarios','colors','tallas'));
    }
    public function guardarEntradas() {
        foreach($this->entradas as $key => $entrada){
            //$this->entrada_individual = $entrada.'-'.$key;
            $record = Producto::find($key);
            $record->update([
                'stock' => ($entrada + $record->stock)
            ]);
            $inventario = Inventario::where('producto_id', '=', $record->id)->first();
            $inventario->update([
                'entradas' => $inventario->entradas + $entrada,
                'stock' => $record->stock,
                'ultima_entrada' => date("Y-m-d H:i:s")
            ]);

            $cliente = InventarioDetalle::create([
                'ultima_entrada' => date("Y-m-d H:i:s"),
                'entradas' => $entrada,
                'precio_produccion' => $record->precio_produccion,
                'precio_mayorista' => $record->precio_mayorista,
                'precio_venta_publico' => $record->precio_venta_publico,
                'stock' => $record->stock,
                'producto_id' => $key
            ]);
        }
    }
    public function updatingSearchCodigoBarras()
    {
        $this->resetPage();
    }
    public function updatingSearchColor()
    {
        $this->resetPage();
    }
    public function updatingSearchTalla()
    {
        $this->resetPage();
    }
}
