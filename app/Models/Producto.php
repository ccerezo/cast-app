<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','codigo_barras','descripcion', 'precio_produccion','precio_mayorista','precio_venta_publico',
                            'stock','descuento','iva','image','activo','bodega_id','marca_id','categoria_id',
                            'modelo_id', 'linea_id', 'talla_id','color_id'];

    public function bodega() {
        return $this->belongsTo('App\Models\Bodega');
    }

    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function color() {
        return $this->belongsTo('App\Models\Color');
    }

    public function linea() {
        return $this->belongsTo('App\Models\Linea');
    }

    public function marca() {
        return $this->belongsTo('App\Models\Marca');
    }

    public function modelo() {
        return $this->belongsTo('App\Models\Modelo');
    }

    public function talla() {
        return $this->belongsTo('App\Models\Talla');
    }
    public function inventario() {
        return $this->hasMany('App\Models\Inventario');
    }
}
