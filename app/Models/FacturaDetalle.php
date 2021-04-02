<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['precio_produccion','precio_mayorista','precio_venta_publico','cantidad','descuento','factura_id','iva','factura_id','producto_id'];

    public function producto() {
        return $this->belongsTo('App\Models\Producto');
    }
    public function factura() {
        return $this->belongsTo('App\Models\Factura');
    }
}
