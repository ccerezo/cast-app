<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['identificacion', 'nombre', 'direccion', 'telefono', 'correo', 'activo', 'tipo_cliente_id'];

    public function tipoCliente() {
        return $this->belongsTo('App\Models\TipoCliente');
    }

    public function facturas() {
        return $this->hasMany('App\Models\Factura');
    }

    public function cupos() {
        return $this->hasMany('App\Models\Cupo');
    }

}
