<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['numero','fecha','subtotal','iva','total','descuento','forma_pago', 'observacion', 'vencimiento',
                            'facturado_como_id','cliente_id','cajero_id','estado_factura_id'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function tipoCliente() {
        return $this->belongsTo('App\Models\TipoCliente');
    }
    public function user() {
        return $this->belongsTo('App\Models\Users');
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
