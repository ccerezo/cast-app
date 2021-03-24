<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $fillable = ['entradas','ultima_entrada','salidas','ultima_salida','stock','producto_id'];

    public function producto() {
        return $this->belongsTo('App\Models\Producto');
    }
}
