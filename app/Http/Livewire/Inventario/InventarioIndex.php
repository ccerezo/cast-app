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
    public $entradas = array();
    public $salidas = array();
    public $ingresar_entradas = false;
    public $ingresar_salidas = false;
    public $inventarioDetalle;
    public $bandera;
    public $openModal = false;
    public $openGuardarEntradas = false;
    public $elaboradoPor;

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
    public function openIngresarEntradas(){
        $this->ingresar_entradas = true;
    }
    public function openIngresarSalidas(){
        $this->ingresar_salidas = true;
    }
    public function openEntradasSalidas(Producto $producto){
        $this->inventarioDetalle = InventarioDetalle::where('producto_id', '=', $producto->id)->get();
        $this->openModal = true;
    }
    public function openAlertEntrada(Producto $producto){
        if(count($this->entradas) > 0){
            $this->openGuardarEntradas = true;
        } else {
            $this->reset(['entradas','ingresar_entradas']);
        }
    }
    public function guardarEntradas() {
        if(count($this->entradas) > 0){
            foreach($this->entradas as $key => $entrada){
                if (is_numeric($entrada)) {
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
                        'producto_id' => $key,
                        'descripcion' => $this->elaboradoPor
                    ]);
                }
                //$this->entrada_individual = $entrada.'-'.$key;
            }
            session()->flash('message', 'Post successfully updated.');
        }
        $this->reset(['entradas','ingresar_entradas','openGuardarEntradas']);
    }
    public function guardarSalidas() {
        if(count($this->salidas) > 0){
            foreach($this->salidas as $key => $salida){
                if (is_numeric($salida)) {
                    $record = Producto::find($key);
                    $record->update([
                        'stock' => ($record->stock - $salida)
                    ]);
                    $inventario = Inventario::where('producto_id', '=', $record->id)->first();
                    $inventario->update([
                        'salidas' => $inventario->salidas + $salida,
                        'stock' => $record->stock,
                        'ultima_salida' => date("Y-m-d H:i:s")
                    ]);

                    $detalle = InventarioDetalle::create([
                        'ultima_salida' => date("Y-m-d H:i:s"),
                        'salidas' => $salida,
                        'precio_produccion' => $record->precio_produccion,
                        'precio_mayorista' => $record->precio_mayorista,
                        'precio_venta_publico' => $record->precio_venta_publico,
                        'stock' => $record->stock,
                        'producto_id' => $key
                    ]);
                }
                //$this->entrada_individual = $entrada.'-'.$key;
            }
        }
        $this->reset(['salidas','ingresar_salidas']);
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
    public function updatingEntradas()
    {
        $this->resetPage();
    }
}
