<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['salidas', 'fecha', 'inventario_materia_prima_id'];

    public function inventarioMateriaPrima() {
        return $this->belongsTo('App\Models\InventarioMateriaPrima');
    }
}
