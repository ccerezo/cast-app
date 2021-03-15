<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;

    protected $fillable = ['numero1','numero2','activo'];

    public function productos() {
        return $this->hasMany('App\Models\Producto');
    }
    public function tallajes() {
        return $this->hasMany('App\Models\Tallaje');
    }
}
