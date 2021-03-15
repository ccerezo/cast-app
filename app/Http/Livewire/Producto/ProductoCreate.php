<?php

namespace App\Http\Livewire\Producto;

use App\Models\Bodega;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Linea;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Tallaje;
use Livewire\Component;

class ProductoCreate extends Component
{
    public $lineaSelected;
    public function render()
    {
        $lineas = Linea::pluck('nombre','id');
        $categorias = Categoria::pluck('nombre','id');
        $bodegas = Bodega::pluck('nombre','id');
        $marcas = Marca::pluck('nombre','id');
        $modelos = Modelo::pluck('nombre','id');
        $colores = Color::all();
        $lineas_tallaje = Linea::pluck('id')->first();
        if(isset($this->lineaSelected) && $this->lineaSelected > 0){
            $tallajes = Tallaje::where('linea_id', '=', $this->lineaSelected)->pluck('talla_id');
            $tallas = Talla::whereIn('id', $tallajes)->get();
        } else {
            $tallajes = Tallaje::where('linea_id', '=', $lineas_tallaje)->pluck('talla_id');
            $tallas = Talla::whereIn('id', $tallajes)->get();
        }

        return view('livewire.producto.producto-create', compact('lineas','categorias','tallas','bodegas','marcas','modelos','colores'));
    }
}
