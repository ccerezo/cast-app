<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioMateriaPrima extends Model
{
    use HasFactory;

    protected $fillable = ['stock', 'costo_unidad', 'fecha_compra', 'activo', 'materia_prima_id','proveedor_id'];

    public function materiaPrima() {
        return $this->belongsTo('App\Models\MateriaPrima');
    }

    public function proveedor() {
        return $this->belongsTo('App\Models\Proveedor');
    }

    public function materiaPrimaDetalle() {
        return $this->hasMany('App\Models\MateriaPrimaDetalle');
    }
}
