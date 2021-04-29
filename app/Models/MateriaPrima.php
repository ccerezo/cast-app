<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'descripcion', 'unidad', 'activo'];

    public function inventarioMateriaPrima() {
        return $this->hasMany('App\Models\InventarioMateriaPrima');
    }
}
