<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoFactura extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','codigo','activo'];

    public function facturas() {
        return $this->hasMany('App\Models\Factura');
    }
}
