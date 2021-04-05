<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['numero','fecha','subtotal','iva','total','descuento','forma_pago','tipo',
                            'cliente_id','vendedor_id','estado_factura_id'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function vendedor() {
        return $this->belongsTo('App\Models\Vendedor');
    }
    public function estadoFactura() {
        return $this->belongsTo('App\Models\EstadoFactura');
    }
    public function facturaDetalle() {
        return $this->hasMany('App\Models\FacturaDetalle');
    }
    public function pagoFacturas() {
        return $this->hasMany('App\Models\PagoFactura');
    }
}
