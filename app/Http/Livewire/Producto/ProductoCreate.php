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
    public $colorSelected = 1;
    public function render()
    {
        $lineas = Linea::orderBy('nombre', 'asc')->pluck('nombre','id');
        $categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre','id');
        $bodegas = Bodega::pluck('nombre','id');
        $marcas = Marca::orderBy('nombre', 'asc')->pluck('nombre','id');
        $modelos = Modelo::orderBy('nombre', 'asc')->pluck('nombre','id');
        $colorTmp = Color::orderBy('nombre', 'asc')->pluck('nombre','id');
        $colores = Color::where('id','=',$this->colorSelected)->orderBy('nombre', 'asc')->get();
        $lineas_tallaje = Linea::pluck('id')->first();
        $descuentos = ['0'=> '0%','5'=> '5%','10' =>'10%','15' =>'15%','20' =>'20%','25' =>'25%','30' =>'30%'];
        if(isset($this->lineaSelected) && $this->lineaSelected > 0){
            $tallajes = Tallaje::where('linea_id', '=', $this->lineaSelected)->pluck('talla_id');
            $tallas = Talla::whereIn('id', $tallajes)->get();
        } else {
            $tallajes = Tallaje::where('linea_id', '=', $lineas_tallaje)->pluck('talla_id');
            $tallas = Talla::whereIn('id', $tallajes)->get();
        }

        return view('livewire.producto.producto-create', compact('lineas','categorias','tallas','bodegas','marcas','modelos','colores','colorTmp','descuentos'));
    }
}
