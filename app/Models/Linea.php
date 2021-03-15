<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','codigo','descripcion','activo'];

    public function productos() {
        return $this->hasMany('App\Models\Producto');
    }

    public function tallajes() {
        return $this->hasMany('App\Models\Tallaje');
    }
}
