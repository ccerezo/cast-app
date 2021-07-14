<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['entradas','ultima_entrada','salidas','ultima_salida','stock','precio_produccion','precio_mayorista','precio_venta_publico','descripcion','producto_id'];

    public function producto() {
        return $this->belongsTo('App\Models\Producto');
    }
}
