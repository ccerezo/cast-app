<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagoFactura extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','monto','descripcion','factura_id','metodo_pago_id'];

    public function factura() {
        return $this->belongsTo('App\Models\Factura');
    }
    public function metodoPago() {
        return $this->belongsTo('App\Models\MetodoPago');
    }
}
