<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallaje extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'activo', 'linea_id', 'talla_id'];

    public function linea() {
        return $this->belongsTo('App\Models\Linea');
    }

    public function talla() {
        return $this->belongsTo('App\Models\Talla');
    }
}
