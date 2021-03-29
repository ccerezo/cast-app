<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $fillable = ['identificacion', 'nombre', 'cupo_aprobado', 'cupo_disponible', 'codigo', 'correo', 'telefono', 'activo'];

    public function facturas() {
        return $this->hasMany('App\Models\Factura');
    }
}
